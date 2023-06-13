<table class="table table-bordered table-striped table-hover">
    @for($i = 1; $i <= 31; $i++)
        @if ($i % 7 == 1)
            <tr>   
        @endif
        <th>{{ $i }}</th>
        @if ($i % 7 == 0)
            </tr>
        @endif
    @endfor
</table>