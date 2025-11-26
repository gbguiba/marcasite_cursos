<?php

namespace App\Http\Controllers\API;

use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\CourseCategoryResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CourseCategoryStoreRequest;
use App\Http\Requests\CourseCategoryUpdateRequest;

class CourseCategoryController extends Controller {
    
    public function index(): AnonymousResourceCollection {

        return CourseCategoryResource::collection(CourseCategory::paginate(10));

    }

    public function store(CourseCategoryStoreRequest $request): JsonResponse {
        
        $validated = $request->validated();

        $validated['ip'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();
        
        CourseCategory::create($validated);

        return response()->json([
            'message' => 'Categoria criada com sucesso.',
        ], 201);

    }
    
    public function show(Request $request, CourseCategory $courseCategory): CourseCategoryResource {

        return new CourseCategoryResource($courseCategory);

    }
    
    public function update(CourseCategoryUpdateRequest $request, CourseCategory $courseCategory): JsonResponse {

        $validated = $request->validated();

        $validated['ip'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();

        $courseCategory->update($validated);

        return response()->json([
            'message' => 'Categoria atualizada com sucesso.',
        ], 200);

    }
    
    public function destroy(CourseCategory $courseCategory): JsonResponse {

        $courseCategory->delete();

        return response()->json([
            'message' => 'Categoria excluída com sucesso.',
        ], 200);

    }

}
