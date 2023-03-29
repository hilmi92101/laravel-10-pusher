<?php

namespace App\Http\Controllers\Api\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Visitor;

class PusherController extends Controller
{
    private $visitor , $token, $token_expires_at;
    private $token_name = 'visitor-token';
    private $hours = 12;

    public function createToken(Request $request)
    {
        $this->deleteOldVisitors();
        //$this->deleteOldTokens();
        $this->storeVisitor();
        $this->generateToken();

        return response()->json([   
            'success' => true,   
            'token' => $this->token,   
            //'token_expires_at' => $this->token_expires_at
        ]);
    }

    private function deleteOldVisitors()
    {
        $hours_ago = Carbon::now()->subHours($this->hours);
        Visitor::where('created_at', '<', $hours_ago)->delete();
    }

    public function deleteOldTokens()
    {
        $hours_ago = Carbon::now()->subHours($this->hours);
        Token::where('name', $this->token_name)->where('created_at', '<=', $hours_ago)->delete();
    }

    private function storeVisitor()
    {
        $visitor = new Visitor();
        $visitor->name = 'visitor_' . Str::random(6) . '_' . time();
        $visitor->password = Hash::make('1q2w3e4r');
        $visitor->save();

        $this->visitor = $visitor;
    }

    private function generateToken()
    {
        $visitor = $this->visitor;
        //$expires_at = now()->addHours($this->hours);

        $this->token = $visitor->createToken($this->token_name)->plainTextToken;
        //$this->token_expires_at = $expires_at->toDateTimeString();
    }
}
