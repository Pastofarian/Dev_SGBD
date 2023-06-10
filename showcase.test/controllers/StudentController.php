<?php

class StudentController {
    //liste les students
    public function index () {
        $students = Student::all();
        include '../views/students/list.php';
    }
    
    //affiche un student
    public function show ($id) {
        $student = Student::find($id);
        if ($student) {
            return include '../views/students/one.php'; 
        }
        return include '../views/students/notfound.php';
    }
    
    //affiche le formulaire de création
    public function create () {
        return include '../views/students/create.php';
    }
    
    //affiche le formulaire d'édition
    public function edit ($id) {
        $student = Student::find($id);
        if ($student) {
            return include '../views/students/edit.php';
        }
        return include '../views/students/notfound.php';
    }
    
    //sauvegarde un student
    public function store ($data) {
        $student = new Student(false, $data["name"]);
        $student->save();
        return include '../views/students/store.php';
    }
    
    //met a jour un student
    public function update ($id, $data) {
        $student = Student::find($id);
        if ($student) {
            $student->name = $data["name"] ? $data["name"] : $student->name;
            $student->save();
            return include '../views/students/update.php';
        }
        return include '../views/students/notfound.php';
    }
    
    
    //suppr un student
    public function destroy ($id) {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return include '../views/students/delete.php';
        }
        return include '../views/students/notfound.php';
    }
}