<?php
class StudentModel {
    private $file = __DIR__ . '/../data/students.json';

    public function getAll() {
        if (!file_exists($this->file)) return [];
        $data = file_get_contents($this->file);
        return json_decode($data, true) ?: [];
    }

    public function save($student) {
        $students = $this->getAll();
        $students[] = $student;
        file_put_contents($this->file, json_encode($students, JSON_PRETTY_PRINT));
    }
}
