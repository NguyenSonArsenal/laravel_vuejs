<?php

namespace App\Models\Base;

use App\Http\Supports\RandomStringGenerator;
use Illuminate\Support\Facades\Hash;

trait ApiToken
{
    /**
     * @return string
     */
    public function accessTokenFieldName()
    {
        return 'accessToken';
    }

    /**
     *
     */
    public function resetAccessToken()
    {
        $this->updateAccessToken();
    }

    /**
     * @return string
     */
    public function renewAccessToken()
    {
        $accessToken = $this->genAccessToken();
        $this->updateAccessToken($accessToken);
        return $accessToken;
    }

    /**
     * @param string $value
     * @return mixed
     */
    public function updateAccessToken($value = '')
    {
        $fieldName = $this->accessTokenFieldName();
        $fillable = $this->getFillable();
        $fillable[] = $fieldName;
        $this->fillable($fillable)->$fieldName = $value;
        return $this->save();
    }

    /**
     * @return string
     */
    public function genAccessToken()
    {
        $token = (new RandomStringGenerator())->generate(getConstant('TOKEN_LOGIN_LENGTH', 32)); // hash token
        return Hash::make($token);
    }

}
