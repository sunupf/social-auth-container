<?php

namespace App\Containers\Vendor\SocialAuth\UI\API\Controllers;

use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Containers\Vendor\SocialAuth\Actions\SocialLoginAction;
use App\Containers\Vendor\SocialAuth\UI\API\Requests\ApiAuthenticateRequest;
use Apiato\Core\Abstracts\Controllers\ApiController;

class Controller extends ApiController
{
	public function authenticateAll(ApiAuthenticateRequest $request): array
	{
		$data = app(SocialLoginAction::class)->run($request);

		return $this->transform($data['user'], UserTransformer::class, [], [
			'token_type' => 'personal',
			'access_token' => $data['token']->accessToken,
		]);
	}
}
