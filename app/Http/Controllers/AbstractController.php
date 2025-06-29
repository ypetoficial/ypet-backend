<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

abstract class AbstractController extends Controller
{
    protected array $with = [];

    protected array $withCount = [];

    protected $service;

    protected $requestValidate;

    protected $requestValidateUpdate;

    private array $validated;

    public function index(Request $request): JsonResponse
    {
        if (! isset($request->with)) {
            $request->with = $this->with;
        }

        $items = $this
            ->service
            ->all($request->all(), $request->with)
            ->toArray();

        return $this->ok($items);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            if ($this->requestValidate) {
                $requestValidate = app($this->requestValidate);
                $this->validated = $request->validate($requestValidate->rules());
            }
        } catch (ValidationException $e) {
            return $this->error($this->messageErrorDefault, $e->errors());
        }

        try {
            DB::beginTransaction();
            $response = $this->service->save($this->validated);
            DB::commit();

            return $this->success($this->messageSuccessDefault, ['response' => $response]);
        } catch (\Exception|ValidationException $e) {
            DB::rollBack();
            if ($e instanceof ValidationException) {
                return $this->error($this->messageErrorDefault, $e->errors());
            }
            if ($e instanceof Exception) {
                return $this->error($e->getMessage());
            }
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            if (! empty($this->requestValidateUpdate)) {
                $requestValidateUpdate = app($this->requestValidateUpdate);
                $this->validated = $request->validate($requestValidateUpdate->rules());
            }
        } catch (ValidationException $e) {
            return $this->error($this->messageErrorDefault, $e->errors());
        }

        try {
            DB::beginTransaction();
            $this->service->update($id, $this->validated);
            DB::commit();

            return $this->success($this->messageSuccessDefault);
        } catch (\Exception|ValidationException $e) {
            DB::rollBack();
            if ($e instanceof Exception) {
                return $this->error($e->getMessage());
            }
            if ($e instanceof ValidationException) {
                return $this->error($this->messageErrorDefault, $e->errors());
            }
        }
    }

    public function show($id, Request $request): JsonResponse
    {
        if (! isset($request->with)) {
            $request->with = $this->with;
        }

        if (! isset($request->withCount)) {
            $request->withCount = $this->withCount;
        }

        try {
            return $this->ok($this->service->find($id, $request->with, $request->withCount)->toArray());
        } catch (\Exception|ValidationException $e) {
            DB::rollBack();
            if ($e instanceof Exception) {
                return $this->error($e->getMessage());
            }
            if ($e instanceof ValidationException) {
                return $this->error($this->messageErrorDefault, $e->errors());
            }
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->service->delete($id);

            return $this->success($this->messageSuccessDefault);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * @param  null  $id
     */
    public function preRequisite($id = null): JsonResponse
    {
        $preRequisite = $this->service->preRequisite($id);

        return $this->ok(compact('preRequisite'));
    }

    public function toSelect(): JsonResponse
    {
        return $this->ok($this->service->toSelect(request()->all()));
    }
}
