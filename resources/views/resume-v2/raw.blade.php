<?php
function getExperiencePercentage($experienceLevel)
{
    switch ($experienceLevel) {
        case 'Master':
            return 100;
        case 'Advanced':
            return 80;
        case 'Expert':
            return 70;
        case 'Intermediate':
            return 60;
        case 'Beginner':
            return 40;
        default:
            return 0;
    }
}
?>

<div class="card shadow border-0">
    <div class="table-responsive no-page-break">
        @include('resume-v2.about')
        <table class="resume-table rounded">
            <tbody>
                <tr>
                    <td style="width: 70%; padding-inline:16px;vertical-align:top">
                        <div class="table-responsive">
                            <table class="resume-table">
                                <tr>
                                    <td>
                                        @include('resume-v2.companies')
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <td style="width: 30%; padding-inline:16px;vertical-align:top">
                        <div class="table-responsive overflow-hidden">
                            <table class="resume-table">
                                <tr>
                                    <td>
                                        @include('resume-v2.skills_categories', ['part' => 1])
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                {{-- Force page break after this --}}
                <tr class="page-break">
                    <td style="width: 70%; padding-inline:16px;vertical-align:top">
                        <div class="table-responsive">
                            <table class="resume-table">
                                <tr>
                                    <td>
                                        @include('resume-v2.companies', ['part' => 2])
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <td style="width: 30%; padding-inline:16px;vertical-align:top">
                        <div class="table-responsive overflow-hidden">
                            <table class="resume-table">
                                <tr>
                                    <td>
                                        @include('resume-v2.projects')
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @include('resume-v2.qualifications')
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
