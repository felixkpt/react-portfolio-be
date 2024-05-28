<?php

namespace App\Providers;

use App\Services\Validations\About\AboutValidation;
use App\Services\Validations\About\AboutValidationInterface;
use App\Services\Validations\Company\CompanyValidation;
use App\Services\Validations\Company\CompanyValidationInterface;
use App\Services\Validations\ContactMe\ContactMeValidation;
use App\Services\Validations\ContactMe\ContactMeValidationInterface;
use App\Services\Validations\ExperienceLevel\ExperienceLevelValidation;
use App\Services\Validations\ExperienceLevel\ExperienceLevelValidationInterface;
use App\Services\Validations\GetInTouch\GetInTouchValidation;
use App\Services\Validations\GetInTouch\GetInTouchValidationInterface;
use App\Services\Validations\Permission\PermissionValidation;
use App\Services\Validations\Permission\PermissionValidationInterface;
use App\Services\Validations\Post\Category\PostCategoryValidation;
use App\Services\Validations\Post\Category\PostCategoryValidationInterface;
use App\Services\Validations\Post\PostValidation;
use App\Services\Validations\Post\PostValidationInterface;
use App\Services\Validations\PostStatus\PostStatusValidation;
use App\Services\Validations\PostStatus\PostStatusValidationInterface;
use App\Services\Validations\Project\ProjectSlide\ProjectSlideValidation;
use App\Services\Validations\Project\ProjectSlide\ProjectSlideValidationInterface;
use App\Services\Validations\Project\ProjectValidation;
use App\Services\Validations\Project\ProjectValidationInterface;
use App\Services\Validations\Qualification\QualificationValidation;
use App\Services\Validations\Qualification\QualificationValidationInterface;
use App\Services\Validations\Role\RoleValidation;
use App\Services\Validations\Role\RoleValidationInterface;
use App\Services\Validations\Skill\SkillValidation;
use App\Services\Validations\Skill\SkillValidationInterface;
use App\Services\Validations\SkillCategory\SkillCategoryValidation;
use App\Services\Validations\SkillCategory\SkillCategoryValidationInterface;
use App\Services\Validations\Status\StatusValidation;
use App\Services\Validations\Status\StatusValidationInterface;
use App\Services\Validations\User\UserValidation;
use App\Services\Validations\User\UserValidationInterface;
use App\Services\Validations\WorkExperience\WorkExperienceValidation;
use App\Services\Validations\WorkExperience\WorkExperienceValidationInterface;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // App core bindings
        $this->app->bind(RoleValidationInterface::class, RoleValidation::class);
        $this->app->bind(PermissionValidationInterface::class, PermissionValidation::class);
        $this->app->bind(PostValidationInterface::class, PostValidation::class);
        $this->app->bind(UserValidationInterface::class, UserValidation::class);
        $this->app->bind(PostCategoryValidationInterface::class, PostCategoryValidation::class);
        $this->app->bind(StatusValidationInterface::class, StatusValidation::class);
        $this->app->bind(PostStatusValidationInterface::class, PostStatusValidation::class);
        // App business logic bindings
        $this->app->bind(AboutValidationInterface::class, AboutValidation::class);
        $this->app->singleton(ExperienceLevelValidationInterface::class, ExperienceLevelValidation::class);
        $this->app->singleton(GetInTouchValidationInterface::class, GetInTouchValidation::class);
        $this->app->singleton(ProjectValidationInterface::class, ProjectValidation::class);
        $this->app->singleton(ProjectSlideValidationInterface::class, ProjectSlideValidation::class);
        $this->app->singleton(QualificationValidationInterface::class, QualificationValidation::class);
        $this->app->singleton(SkillValidationInterface::class, SkillValidation::class);
        $this->app->singleton(SkillCategoryValidationInterface::class, SkillCategoryValidation::class);
        $this->app->singleton(WorkExperienceValidationInterface::class, WorkExperienceValidation::class);
        $this->app->singleton(CompanyValidationInterface::class, CompanyValidation::class);
        $this->app->singleton(ContactMeValidationInterface::class, ContactMeValidation::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
