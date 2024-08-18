@if (count($contacts) > 0)
    <div class="mb-1">
        <table class="resume-table" style="width: 100%; table-layout: fixed;">
            <tr>
                <td class="pt-0" style="width: 100%;">
                    <div style="display: grid; justify-content: end;">
                        @foreach ($contacts as $contact)
                            <div style="display: grid; grid-template-columns: auto 1fr; gap: 8px; align-items: center; justify-content: end;margin-bottom:8px">
                                <img src="{{ asset($contact->image) }}" alt="{{ $contact->name }}"
                                    class="contact-icon" style="width: 24px; height: 24px;margin-right:5px">
                                <a class="contact-link" href="{{ $contact->link }}" target="_blank">{{ $contact->link }}</a>
                            </div>
                        @endforeach
                    </div>
                </td>
            </tr>
        </table>
    </div>
@endif
