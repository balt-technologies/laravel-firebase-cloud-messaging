<?php

namespace BaltTechnologies\LaravelFirebaseCloudMessaging\Http\Controllers;

use BaltTechnologies\LaravelFirebaseCloudMessaging\Http\Resources\CloudMessagingTokenResource;
use BaltTechnologies\LaravelFirebaseCloudMessaging\Models\CloudMessagingToken;
use BaltTechnologies\LaravelFirebaseCloudMessaging\Services\CloudMessaging\CloudMessagingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CloudMessagingController extends Controller
{
    /**
     * @var CloudMessagingService
     */
    protected CloudMessagingService $cloudMessagingService;

    public $meta = ['meta' => ['status' => 'success']];

    public function __construct(CloudMessagingService $cloudMessagingService)
    {
        $this->cloudMessagingService = $cloudMessagingService;
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'token' => 'required|string',
        ]);
        $validatedData['user_id'] = Auth::user()->id;
        $cloudMessagingToken = CloudMessagingToken::create($validatedData);

        return CloudMessagingTokenResource::make($cloudMessagingToken);
    }

    public function view(CloudMessagingToken $cloudMessagingToken)
    {
        return CloudMessagingTokenResource::make($cloudMessagingToken);
    }

    public function delete(Request $request)
    {
        $validatedData = $request->validate([
            'cloud_messaging_token' => 'required|string',
        ]);
        $cloudMessagingToken = CloudMessagingToken::where('id', '=', $validatedData['cloud_messaging_token'])->first();
        $cloudMessagingToken->delete();

        return response()->json($this->meta);
    }

    public function index()
    {
        $user = Auth::user();

        return CloudMessagingTokenResource::collection($user->cloudMessagingTokens);
    }
}
