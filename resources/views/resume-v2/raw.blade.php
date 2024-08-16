<style>
    .link-unstyled {

        &,
        &:visited,
        &:hover,
        &:active,
        &:focus,
        &:active:hover {
            font-style: inherit;
            color: inherit;
            background-color: transparent;
            font-size: inherit;
            text-decoration: none;
            font-variant: inherit;
            font-weight: inherit;
            line-height: inherit;
            font-family: inherit;
            border-radius: inherit;
            border: inherit;
            outline: inherit;
            box-shadow: inherit;
            padding: inherit;
            vertical-align: inherit;
        }
    }

    .resume-section-title {
        font-size: 1.7rem;
        position: relative;
        color: #434E5E;
    }

    .resume-sub-title {
        font-size: 1.25rem;
        color: #434E5E;
        text-decoration: none;
    }

    .resume-sub-title:hover {
        color: #434E5E;
    }

    .cursor-default {
        cursor: default;
    }

    .col-auto {
        flex: 0 0 auto;
        width: auto;
    }

    /* Avoid page break after the about section */
    .no-page-break {
        page-break-inside: avoid;
        break-inside: avoid;
    }

    /* Force page break after the first table row set */
    .page-break {
        page-break-after: always;
        break-after: page;
    }

    .custom-progress-bar {
        background-color: #ccc;
        border-radius: 4px;
        overflow: hidden;
        height: 12px;
        margin-top: 5px;
    }

    .custom-progress {
        background-color: #434E5E;
        height: 100%;
        border-radius: 4px;
        transition: width 0.3s ease-in-out;
    }
</style>
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

<div class="card shadow border-0 my-3">
    <div class="table-responsive no-page-break">
        @include('resume-v2.about')
        <table class="table table-borderless table-sm m-0 px-1 rounded">
            <tbody>
                <tr>
                    <td style="width: 70%; padding:0;vertical-align:top">
                        <div class="table-responsive">
                            <table class="table table-borderless table-sm m-0 px-1">
                                <tr>
                                    <td>
                                        @include('resume-v2.companies')
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <td style="width: 30%; padding:0;vertical-align:top">
                        <div class="table-responsive overflow-hidden">
                            <table class="table table-borderless table-sm m-0 px-1">
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
                    <td style="width: 70%; padding:0;vertical-align:top">
                        <div class="table-responsive">
                            <table class="table table-borderless table-sm m-0 px-1">
                                <tr>
                                    <td>
                                        @include('resume-v2.companies', ['part' => 2])
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <td style="width: 30%; padding:0;vertical-align:top">
                        <div class="table-responsive overflow-hidden">
                            <table class="table table-borderless table-sm m-0 px-1">
                                <tr>
                                    <td>
                                        @include('resume-v2.skills_categories', ['part' => 2])
                                    </td>
                                </tr>
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
