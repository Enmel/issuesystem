<?php

use App\Http\Resources\Group;
use App\Models\Member;
use Illuminate\Support\Facades\Route;

//? Users
Route::get('users', Users\ListUsers::class);
Route::post('users', Users\Create::class);
Route::put('users/{id}', Users\Update::class);
Route::delete('users/{id}', Users\Remove::class);
Route::post('users/authenticate', Users\Login::class);

//? Groups
Route::get('groups', Groups\ListGroups::class);
Route::post('groups', Groups\Create::class);
Route::get('groups/{id}', Groups\Show::class);
Route::put('groups/{id}', Groups\Update::class);
Route::delete('groups/{id}', Groups\Remove::class);

//? Members
Route::get('groups/{groupID}/members', Members\ListMembers::class);
Route::post('groups/{groupID}/members', Members\AddMembers::class);
Route::delete('groups/{groupID}/members/{userID}', Members\Remove::class);

//? Issues
Route::get('issues', Issues\ListIssues::class);
Route::get('issues/{issueID}', Issues\Show::class);
Route::post('issues', Issues\Create::class);
Route::post('issues/{issueID}/toggleState', Issues\ToggleState::class);

//? IssueComment
Route::post('issues/{issueID}/comment', IssuesComment\Create::class);

//? Errors
Route::get('errors', Errors\ListErrors::class);
Route::get('errors/{errorID}', Errors\Show::class);
Route::post('errors', Errors\Create::class);
Route::post('errors/{errorID}/toggleState', Errors\ToggleState::class);

//? ErrorComment
Route::post('errors/{errorID}/comment', ErrorComment\Create::class);

//? Files
Route::post('files', Files\Upload::class);

//? Avatar Service
Route::get('avatar', Avatar\Generate::class);
