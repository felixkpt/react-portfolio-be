<?php

namespace App\Providers;

use App\Repositories\About\AboutRepository;
use App\Repositories\About\AboutRepositoryInterface;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\ContactMe\ContactMeRepository;
use App\Repositories\ContactMe\ContactMeRepositoryInterface;
use App\Repositories\ExperienceLevel\ExperienceLevelRepository;
use App\Repositories\ExperienceLevel\ExperienceLevelRepositoryInterface;
use App\Repositories\GetInTouch\GetInTouchRepository;
use App\Repositories\GetInTouch\GetInTouchRepositoryInterface;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\PostStatus\PostStatusRepository;
use App\Repositories\PostStatus\PostStatusRepositoryInterface;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Project\ProjectRepositoryInterface;
use App\Repositories\Qualification\QualificationRepository;
use App\Repositories\Qualification\QualificationRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Skill\SkillRepository;
use App\Repositories\Skill\SkillRepositoryInterface;
use App\Repositories\SkillCategory\SkillCategoryRepository;
use App\Repositories\SkillCategory\SkillCategoryRepositoryInterface;
use App\Repositories\Status\StatusRepository;
use App\Repositories\Status\StatusRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\WorkExperience\WorkExperienceRepository;
use App\Repositories\WorkExperience\WorkExperienceRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path('Repositories/helpers.php');

        // App core bindings
        $this->app->singleton(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->singleton(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(StatusRepositoryInterface::class, StatusRepository::class);
        $this->app->singleton(PostStatusRepositoryInterface::class, PostStatusRepository::class);
        // App business logic bindings
        $this->app->singleton(AboutRepositoryInterface::class, AboutRepository::class);
        $this->app->singleton(ExperienceLevelRepositoryInterface::class, ExperienceLevelRepository::class);
        $this->app->singleton(GetInTouchRepositoryInterface::class, GetInTouchRepository::class);
        $this->app->singleton(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->singleton(QualificationRepositoryInterface::class, QualificationRepository::class);
        $this->app->singleton(SkillRepositoryInterface::class, SkillRepository::class);
        $this->app->singleton(SkillCategoryRepositoryInterface::class, SkillCategoryRepository::class);
        $this->app->singleton(WorkExperienceRepositoryInterface::class, WorkExperienceRepository::class);
        $this->app->singleton(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->singleton(ContactMeRepositoryInterface::class, ContactMeRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
