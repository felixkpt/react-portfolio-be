<div class="d-flex flex-wrap p-0">
    <div class="col p-0">
        @foreach ($skills_category->skills->take(5) as $key => $skill)
            <div class="skill-item mb-2">
                <div class="d-flex justify-content-between">
                    <span>{{ $skill->name }}</span>
                </div>
                <div class="custom-progress-bar">
                    <div class="custom-progress" role="progressbar"
                        style="width: {{ getExperiencePercentage($skill?->experienceLevel?->name) }}%;"
                        aria-valuenow="{{ getExperiencePercentage($skill?->experienceLevel?->name) }}" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
            </div>
        @endforeach

    </div>
</div>
