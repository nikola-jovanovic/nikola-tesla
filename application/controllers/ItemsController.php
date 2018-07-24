<?php

// use Item1 as Bla;

class ItemsController extends Controller {

    function show($id, Request $request) {
        var_dump($id);
        var_dump('dsada');
        // $this->set('title', ' - My Todo List App');
        // var_dump($this);
        // $this->set('todo', $this->Item->select($id));
        // die();
        // $item = new Item();
        // $items = $item->find($id);
        // var_dump($items);
        $this->view('items/show', [
            'title' => ' - My Todo List App'
        ]);
    }

    function viewall(string $id) {
        var_dump($id);
        // $this->set('title','All Items - My Todo List App');
        // $this->set('bla', $bla);
    }

    function add(Request $request) {
        // var_dump($request);
        // var_dump($request->input('title'));
        // var_dump($request->input('summary'));

        $item = new Item();
        $item->title = 'fdsfdsd';
        $item->summary = 'dsadadsa';
        $item->save();

        var_dump($item);
        // $todo = $_POST['todo'];
        // $this->set('title','Success - My Todo List App');
    }

    function delete($id = null) {
        // $this->set('title','Success - My Todo List App');
    }

}
