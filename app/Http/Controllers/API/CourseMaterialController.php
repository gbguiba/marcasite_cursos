<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CourseMaterial;
use Illuminate\Http\Request;
use App\Http\Resources\CourseMaterialResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CourseMaterialStoreRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CourseMaterialUpdateRequest;
use Illuminate\Support\Facades\Storage;

class CourseMaterialController extends Controller {
    
    public function index(Request $request): AnonymousResourceCollection {

        $materials = CourseMaterial::with(['course']);

        if ($request->has('search')) {

            $materials->where('name', 'like', "%{$request->query('search')}%")
                      ->orWhere('description', 'like', "%{$request->query('search')}%");

        }
        
        return CourseMaterialResource::collection($materials->paginate(10));
    
    }
    
    public function show(CourseMaterial $courseMaterial): CourseMaterialResource {
        
        return new CourseMaterialResource($courseMaterial);
    
    }

    public function destroy(CourseMaterial $courseMaterial): JsonResponse {
        
        $courseMaterial->delete();

        return response()->json([
            'message' => 'Material excluído com sucesso.',
        ], 200);

    }
    
    public function store(CourseMaterialStoreRequest $request): JsonResponse {
        
        $validated = $request->validated();

        $validated['ip'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();

        if (isset($validated['path'])) {

            $validated['path'] = $validated['path']->store('materials', 'public');

        }

        DB::transaction(function() use ($validated) {

            CourseMaterial::create(Arr::only($validated, (new CourseMaterial())->getFillable()));

        });

        return response()->json([
            'message' => 'Material criado com sucesso.',
        ], 201);

    }
    
    public function update(CourseMaterialUpdateRequest $request, CourseMaterial $courseMaterial): JsonResponse {

        $validated = $request->validated();

        $validated['ip'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();

        if (isset($validated['path'])) {

            $validated['path'] = $validated['path']->store('materials', 'public');

            if ($courseMaterial->path !== null && Storage::disk('public')->exists($courseMaterial->path)) {

                Storage::disk('public')->delete($courseMaterial->path);

            }

        }

        DB::transaction(function() use ($courseMaterial, $validated) {
            
            $courseMaterial->update(Arr::only($validated, $courseMaterial->getFillable()));

        });

        return response()->json([
            'message' => 'Material atualizado com sucesso.',
        ], 200);

    }

}
