<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Company;
use App\Models\GetInTouch;
use App\Models\Project;
use App\Models\Qualification;
use App\Models\SkillCategory;
use PDF;

class ResumeController extends Controller
{
  // Display resume
  public function index()
  {
    return view('resume/index', $this->data());
  }

  private function data()
  {
    $about = About::where('status_id', activeStatusId())->select('current_title', 'name', 'image', 'slogan')->first();
    $companies = Company::where('status_id', activeStatusId())->orderby('start_date', 'desc')->limit(5)->get();
    $contacts = GetInTouch::where('status_id', activeStatusId())->orderby('priority', 'asc')->limit(3)->get();
    $skills_categories = SkillCategory::with(['skills' => fn($q) => $q->orderBy('priority', 'asc')])->where('status_id', activeStatusId())->orderby('priority', 'asc')->limit(4)->get();;
    $projects = Project::where('status_id', activeStatusId())->with(['company', 'skills'])->orderby('priority', 'asc')->limit(3)->get();
    $projects = $this->select($projects);
    $qualifications = Qualification::where('status_id', activeStatusId())->orderby('priority', 'asc')->limit(3)->get();
    return [
      'about' => $about,
      'companies' => $companies,
      'contacts' => $contacts,
      'skills_categories' => $skills_categories,
      'projects' => $projects,
      'qualifications' => $qualifications,
    ];
  }
  // Generate PDF
  public function download()
  {
    // share data to view
    view()->share($this->data());

    $pdf = PDF::loadView('resume/pdf_view', [])->setOption([]);
    // download PDF file with download method
    return $pdf->download($this->data()['about']->name . ' resume.pdf');
  }

  private function select($q)
  {
    return $q->map(
      function ($q) {
        return [
          ...$q->only([
            'id',
            'title',
            'slug',
            'introduction',
            'description',
            'image',
            'project_url'
          ]),
          'company' => $q->company()->first(['name']),
          'skills' => $q->skills()->get(['name'])
        ];
      }
    );
  }
}
