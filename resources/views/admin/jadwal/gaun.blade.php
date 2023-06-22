@php
    // dd($date_1_month[0][0])x
@endphp
<table class="table table-bordered table-striped table-hover">
    @for($i = 1; $i <= count($date_1_month); $i++)
        @if ($i % 7 == 1)
            <tr>   
        @endif
        <th class="{{ count($date_1_month[$i-1][1]) > 0 ? 'bg-blue' : ''  }} text-center">
            {{-- <a href="#" onclick="getDetailJadwal('{{ $role }}','{{ $date_1_month[$i-1][0] }}')" data-bs-toggle="modal" data-bs-target="#modal-xl">
               
            </a> --}}
            <button onclick="getDetailJadwal('{{ $role }}','{{ $date_1_month[$i-1][0] }}')"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-xl">
                {{ $i }}
            </button>
        </th>
        @if ($i % 7 == 0)
            </tr>
        @endif
    @endfor
</table>
