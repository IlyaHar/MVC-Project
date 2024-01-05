<?php

namespace app\controllers\api;
use app\models\Note;
use app\validators\Notes\CreateNotesValidator;
use app\validators\Notes\UpdateNoteValidator;
use enums\SqlOrder;

;
class NotesController extends BaseApiController
{
    public function index()
    {
        return $this->response(
            200,
            Note::where('user_id', '=', authId())
                ->orderBy([
                    'pinned' => SqlOrder::DESC,
                    'completed' => SqlOrder::ASC,
                    'updated_at' => SqlOrder::DESC

                ])
                ->get()
        );

    }

    public function show(int $id)
    {
         $note = Note::find($id);

        if ($note && $note->user_id !== authId()) {
            return $this->response(403, [], [
                'message' => 'This resource is forbidden for you'
            ]);
        }

        return $this->response(200, $note->toArray());
    }

    public function store()
    {
        $data = array_merge(
            requestBody(),
            ['user_id' => authId()]
        );


        $validator = new CreateNotesValidator();
        if ($validator->validate($data) && $note = Note::create($data)) {
            return $this->response(200, $note->toArray());

        }

        return $this->response(200, [], $validator->getErrors());
    }

    public function update(int $id)
    {
        $note = Note::find($id);

        if ($note && $note->user_id !== authId()) {
            return $this->response(403, errors: [
                'message' => 'This resource is forbidden for you'
            ]);
        }

        $data = [
            ...requestBody(),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $validator = new UpdateNoteValidator($note);

        if ($validator->validate($data) && $note = $note->update($data)) {
            return $this->response(body: $note->toArray());
        }

        return $this->response(errors: $validator->getErrors());
    }

    public function destroy(int $id)
    {
        $note = note::find($id);

        if ($note && $note->user_id !== authId()) {
            return $this->response(403, [], [
                'message' => 'This resource is forbidden for you'
            ]);
        }

        $result = Note::destroy($id);

        if (!$result) {
            return $this->response(422, [], ['message' => 'Oops smth went wrong']);
        }

        return $this->response();

    }
}