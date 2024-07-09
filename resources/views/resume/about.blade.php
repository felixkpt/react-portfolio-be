<div class="mb-4">
    <table class="table table-borderless table-sm m-x-0 my-2">
        <tr>
            @if ($about->image)
                <td class="px-2 mb-3">
                    <div style="width:4.7rem;height: 4.7rem;border-radius:50%">
                        <img src="{{ $about->image }}" alt=""
                            style="width:4.6rem;height: 4.6rem;border-radius:50%">
                    </div>
                </td>
            @endif
            <td class="col-11 p-0" style="vertical-align: middle">
                <h3 class="text-primary my-0">{{ $about->name }}</h3>
            </td>
        </tr>
    </table>
    <h6> <small>{{ $about->slogan }}</small> </h6>
    <hr>
</div>
