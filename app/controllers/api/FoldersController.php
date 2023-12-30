<?php

namespace app\controllers\api;

use app\models\Folder;
use app\validators\Folders\CreateFolderValidator;
use enums\SQL;
use enums\SqlOrder;

class FoldersController extends BaseApiController
{
    public function index()
    {
//        dd(Folder::where('user_id', 'IN', [authId(), SQL::NULL->value])->sql());
        return $this->response(
            200,
                 Folder::where('user_id', '=', authId())
                ->orWhere('user_id', 'IS', SQL::NULL->value)
                ->orderBy([
                    'user_id' => SqlOrder::ASC,
                    'title' => SqlOrder::ASC
                ])
                ->get()
        );

    }

    public function show(int $id)
    {
        $folder = Folder::find($id);

        if ($folder && !is_null($folder->user_id) && $folder->user_id !== authId()) {
            return $this->response(403, [], [
                'message' => 'This resource is forbidden for you'
            ]);
        }

        return $this->response(200, $folder->toArray());
    }

    public function store()
    {
        $data = array_merge(
            requestBody(),
            ['user_id' => authId()]
        );
        $validator = new CreateFolderValidator();
        if ($validator->validate($data) && $folder = Folder::create($data)) {
            return $this->response(200, $folder->toArray());

        }

        return $this->response(200, [], $validator->getErrors());
    }

    public function update(int $id)
    {
        $folder = Folder::find($id);

        if ($folder && is_null($folder->user_id) && $folder->user_id !== authId()) {
            return $this->response(403, [], [
                'message' => 'This resource is forbidden for you'
            ]);
        }

        $data = [
            ...requestBody(),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $validator = new CreateFolderValidator();
        if (!$validator->validate($data) && $folder = $folder->update($data)) {
            return $this->response(200, $folder->toArray());
        }

        return $this->response(200, [], $validator->getErrors());


    }

    public function destroy(int $id)
    {
        $folder = Folder::find($id);

        if ($folder && is_null($folder->user_id) && $folder->user_id !== authId()) {
            return $this->response(403, [], [
                'message' => 'This resource is forbidden for you'
            ]);
        }

        $result = Folder::destroy($id);

        if (!$result) {
            return $this->response(422, [], ['message' => 'Oops smth went wrong']);
        }

        return $this->response();

    }
}