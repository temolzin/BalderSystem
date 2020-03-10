<?php
  interface Crud {
    public function read();
    public function insert($data);
    public function delete($id);
    public function update($data);
  }
