<?php

namespace App\Http\Resources\Api\User;

use App\Helpers\Constant;
use App\Http\Resources\Api\Home\CityResource;
use App\Http\Resources\Api\Home\CountryResource;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    protected $token;
    public function __construct($resource, $token =null)
    {
        $this->token = $token;
        parent::__construct($resource);
    }
    public function toArray($request): array
    {
        $Object['id'] = $this->getId();
        $Object['name'] = $this->getName();
        $Object['mobile'] = $this->getMobile();
        $Object['country_id'] = $this->getCountryId();
        $Object['city_id'] = $this->getCityId();
        $Object['Country'] = new CountryResource($this->country);
        $Object['City'] = new CityResource($this->city);
        $Object['email'] = $this->getEmail();
        $Object['bio'] = $this->getBio();
        $Object['address'] = $this->getAddress();
        $Object['mobile_verified_at'] = $this->getMobileVerifiedAt()?Carbon::parse($this->getMobileVerifiedAt())->format('Y-m-d'):null;
        $Object['email_verified_at'] = $this->getEmailVerifiedAt()?Carbon::parse($this->getEmailVerifiedAt())->format('Y-m-d'):null;
        $Object['avatar'] = asset($this->getAvatar());
        $Object['lat'] = $this->getLat();
        $Object['lng'] = $this->getLng();
        $Object['type'] = $this->getType();
        $Object['rate'] = $this->getRate();
        $Object['app_locale'] = $this->getAppLocale();
        $Object['notification_count'] = Notification::where('user_id',$this->getId())->where('read_at',null)->count();
        $Object['access_token'] = $this->token;
        $Object['token_type'] = 'Bearer';
        return $Object;
    }

}
