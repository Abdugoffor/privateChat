<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Models\ChatId;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function chat()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        return view('messages.chat', ['users' => $users]);
    }
    public function index(User $user)
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();

        $chatId = ChatId::where(function ($query) use ($user) {

            $query->where('from_id', auth()->id())
                ->where('to_id', $user->id);

        })->orWhere(function ($query) use ($user) {

            $query->where('from_id', $user->id)
                ->where('to_id', auth()->id());
        })->first();

        if (is_null($chatId)) {
            $chatId = ChatId::create([
                'from_id' => auth()->user()->id,
                'to_id' => $user->id,
            ]);
        }
        $models = Message::where('chat_id', $chatId->id)->orderBy("created_at", "desc")->get();
        return view('messages.index', ['models' => $models, 'users' => $users, 'usersName' => $user, 'chatId' => $chatId]);
    }
    public function store(Request $request, $chatId)
    {
        $data = $request->validate([
            'text' => 'required',
        ]);

        $data['sender_id'] = auth()->user()->id;
        $data['chat_id'] = $chatId;
        $Message = Message::create($data);
        broadcast(new MessageEvent($Message));
        return back();
    }

    public function test()
    {
        // $url = 'https://tarif.customs.uz/spravochnik/viewDatatable.jsp?lang=uz_UZ';

        // // Goutte clientini yaratish
        // $client = new Client();

        // // URLga so'rov yuborish
        // $crawler = $client->request('GET', $url);

        // // HTMLdagi ma'lumotlarni olish
        // $data = $crawler->filter('your-selector-here')->each(function ($node) {
        //     // Ma'lumotni qaytarish
        //     return $node->text();
        // });

        // // Olingan ma'lumotni qaytarish yoki boshqa ishlov berish
        // return response()->json($data);
        dd(123);
    }
}
