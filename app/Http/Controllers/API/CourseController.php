<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CourseStoreRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CourseUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CourseController extends Controller {
    
    public function index(): AnonymousResourceCollection {

        return CourseResource::collection(Course::with(['courseCategory', 'courseMaterials'])->paginate(10));
    
    }

    public function show(Request $request, Course $course): CourseResource {
        
        return new CourseResource($course->load(['courseCategory', 'courseMaterials']));

    }

    public function destroy(Request $request, Course $course): JsonResponse {

        $course->delete();

        return response()->json([
            'message' => 'Curso excluído com sucesso.',
        ], 200);

    }

    public function store(CourseStoreRequest $request): JsonResponse {

        $validated = $request->validated();

        $validated['ip'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();

        if (isset($validated['thumbnail'])) {

            $validated['thumbnail'] = $validated['thumbnail']->store('thumbnails', 'public');

        }

        DB::transaction(function() use ($validated) {
            
            Course::create(Arr::only($validated, (new Course())->getFillable()));

        });

        return response()->json([
            'message' => 'Curso criado com sucesso.',
        ], 201);

    }

    public function update(CourseUpdateRequest $request, Course $course): JsonResponse {

        $validated = $request->validated();
        
        $validated['ip'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();

        if (isset($validated['thumbnail'])) {

            $validated['thumbnail'] = $validated['thumbnail']->store('thumbnails', 'public');

            if ($course->thumbnail !== null && Storage::disk('public')->exists($course->thumbnail)) {

                Storage::disk('public')->delete($course->thumbnail);

            }

        }
        
        DB::transaction(function() use ($course, $validated) {
            
            $course->update(Arr::only($validated, $course->getFillable()));
        
        });
        
        return response()->json([
            'message' => 'Curso atualizado com sucesso.',
        ], 200);

    }

    public function removeThumbnail(Request $request, Course $course): JsonResponse {

        if ($course->thumbnail !== null && Storage::disk('public')->exists($course->thumbnail)) {

            Storage::disk('public')->delete($course->thumbnail);

            DB::transaction(function() use ($course) {

                $course->thumbnail = null;
                $course->save();

            });

            return response()->json([
                'message' => 'Moldura removida com sucesso.',
            ], 200);
        
        }

        throw new HttpException(400, 'Não há moldura para remover.');

    }

}
