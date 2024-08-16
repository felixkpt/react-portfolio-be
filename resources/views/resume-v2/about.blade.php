<style>
    .resume-header {
        background: #434E5E;
        color: rgba(255, 255, 255, 0.9);
        height: 220px;
    }

    .resume-header .contact-link {
        cursor: pointer;
        color: rgba(255, 255, 255, 0.6) !important;
    }

    .resume-header .contact-link:hover {
        color: white !important;
        text-decoration: underline;
    }
</style>
<div class="mb-4 p-0">
    <div class="row resume-header w-100 m-0" style="min-height: 200px;;overflow:hidden">
        <div style="width: 20%;padding:0">
            <div class="d-flex justify-content-start align-items-center px-0">
                <div style="width:100%;height: 100%;">
                    <img src="{{ $about->image }}" alt="" style="width:100%;height: 100%;">
                </div>
            </div>
        </div>
        <div style="width: 80%">
            <div class="mt-3 row p-4 justify-content-center justify-content-md-between">
                <div class="col-auto">
                    <h3 class="my-0">{{ $about->name }}</h3>
                </div>
                <div class="col-auto">
                    @include('resume-v2.contacts')
                </div>
            </div>
            <h6 class="mb-2">{{ $about->slogan }} </h6>
        </div>
    </div>
    <div class="mt-5 px-2">
        <h3 class="resume-section-title">Career Summary</h3>
        <hr>
        {{ $about->introduction }}
    </div>
</div>
