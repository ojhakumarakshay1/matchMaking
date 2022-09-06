<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PartnerPreferenceRepository;
use App\Models\PartnerPreference;
use App\Validators\PartnerPreferenceValidator;

/**
 * Class PartnerPreferenceRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PartnerPreferenceRepositoryEloquent extends BaseRepository implements PartnerPreferenceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PartnerPreference::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
