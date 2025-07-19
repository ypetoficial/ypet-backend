<?php

namespace App\Domains\Abstracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Domains\Abstracts\ServiceInterface;

abstract class AbstractService implements ServiceInterface
{
	protected $with = [];
    protected $repository;

	public function getAll(array $params = [], array $options = [])
	{
		return $this->getRepository()->all($params, $this->with, $options);
	}

	public function getAllWithoutPagination(
        array $params = [],
        array $with = [],
        array $options = [],
    ): Collection {
    	return $this->getRepository()->allWithOutPaginate($params, $with, $options);
    }

	/**
	 * @param $id
	 * @param array $with
	 * @return mixed
	 * @throws \Exception
	 */
	public function find($id, array $with = [])
	{
		$result = $this->repository->find($id, $with);
		if ($result == null) {
			throw new \Exception('Objeto não encontrado na base de dados');
		}
		return $result;
	}

	/**
	 * @param array $data
	 * @return array
	 */
	public function beforeSave(array $data)
	{
		return $data;
	}

	/**
	 * @param $id
	 * @param array $data
	 * @return array
	 */
	public function beforeUpdate($id, array $data)
	{
		return $data;
	}

	/**
	 * @param array $data
	 * @return mixed
	 */
	public function save(array $data)
	{
		$data = $this->beforeSave($data);
		if ($this->validateOnInsert($data) !== false) {
			$entity = $this->repository->create($data);
			$this->afterSave($entity, $data);
			return $entity;
		}
	}

	public function afterSave($entity, array $params)
	{
		return $entity;
	}

	/**
	 * @param $id
	 * @param array $data
	 * @return mixed
	 * @throws \Exception
	 */
	public function update($id, array $data)
	{
		$data = $this->beforeUpdate($id, $data);
		$this->validateOnUpdate($id, $data);
		$entity = $this->find($id);
		$this->afterUpdate($entity, $data);
		return $this->repository->update($entity, $data);
	}

	public function afterUpdate($entity, array $params)
	{
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function beforeDelete($id)
	{
		return $id;
	}

	/**
	 * @param $id
	 * @return mixed
	 * @throws \Exception
	 */
	public function delete($id)
	{
		$this->validateOnDelete($id);
		$this->beforeDelete($id);
		$this->repository->delete($id);
		$this->afterDelete($id);
		return $id;
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function afterDelete($id)
	{
		return $id;
	}

	/**
	 * @param $params
	 * @return bool
	 */
	public function validateOnInsert(array $params)
	{
        return $params;
	}

	/**
	 * @param $id
	 * @param array $params
	 */
	public function validateOnUpdate($id, array $params)
	{
        return $params;
	}

	/**
	 * @param $id
	 * @throws \Exception
	 */
	public function validateOnDelete($id)
	{
		$result = $this->repository->find($id);
		if ($result == null) {
			throw new \Exception('Objeto não encontrado na base de dados');
		}
	}

	/**
	 * @return mixed
	 */
	public function getRepository()
	{
		return $this->repository;
	}

	/**
	 * @return mixed
	 */
	public function getUserAuth()
	{
		return Auth::user();
	}

	/**
	 * @param string $url
	 * @param string $message
	 * @return bool
	 */
	public function makeRequestExterna(string $url, string $messageComparation): bool
	{
		$response = Http::get($url);
		return
			$response->status() === Response::HTTP_OK &&
			$response->json()['message'] == $messageComparation;
	}

	/**
	 * Pre Requisite default
	 */
	public function preRequisite($id = null)
	{

	}

	/**
	 * Simples criação, sem validações
	 * @param array $data
	 * @return mixed
	 */
	public function create(array $data)
	{
		$entity = $this->repository->create($data);
		$this->afterSave($entity, $data);
		return $entity;
	}
}
