<?php

interface IFactory{
    public function getDb(string $dataBaseName);
}