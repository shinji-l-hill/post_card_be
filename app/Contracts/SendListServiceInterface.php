<?php

namespace App\Contracts;

interface SendListServiceInterface

{
  public function store($data);
  public function update($data, $id);
  public function destroy($id);
}