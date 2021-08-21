<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

use App\Models\Settings;
use App\Models\Items;
use App\Models\User;
use App\Models\Comments;
use App\Models\Points;
use App\Models\Notifications;

class CommentController extends Controller
{
    
    // ***
    // Post comment
    // ***
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'comment_text' => 'required|min:'.Settings::find('min_characters_comment')->value.'|max:'.Settings::find('max_characters_comment')->value
        ]);
        
        if ($validator->fails()) {
            return redirect(url()->previous().'#post-comment')
                ->withErrors($validator)
                ->withInput();
        }

        $inserted = Comments::create([
            'user_id' => Auth::id(),
            'item_id' => Request('item_id'),
            'comment_text' => Request('comment_text'),
        ]);
        
        if($inserted == true) {
            
            // notification
            Notifications::create([
                'sender_id' => Auth::id(),
                'recipient_id' => Request('recipient_id'),
                'item_id' => Request('item_id'),
                'notification_type' => "comment",
                'comment_id' => $inserted->id,
                'seen' => 2,
            ]);
            
            if(Settings::find('status_points')->value == 1){
                if(Settings::find('status_points_comments')->value == 1){
                    Points::create([
                        'user_id' => Auth::id(),
                        'point_type' => "comment",
                        'score' => Settings::find('points_comments')->value,
                        'item_id' => Request('item_id'),
                        'comment_id' => $inserted->id
                    ]);
                }
            }
            
            toastr()->success(__('main.toast_the_comment_has_been_inserted'));
            return back();
        } else {
            toastr()->error(__('main.toast_there_are_problems_try_again'));
            return back();
        }
        
    }
    
    // ***
    // Delete Comment
    // ***
    public function delete_comment(Request $request){
        
        $comment = Comments::find($request->comment);
        
        if(Auth::id() == $comment->user_id) {

            DB::table('comments')->where('id', $request->comment)->delete();
            
            return response()->json([
                'bool'=>true
            ]);

        } 
        
    }
    
}