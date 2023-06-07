<select class="f-select" name="pagination" onchange="this.form.submit()" value="{{ $pagination }}">
    @for ($i = 10; $i <= 100; $i += 10)
        <option value="{{ $i }}" {{ empty($pagination) ? '' : ($pagination == $i ? 'selected' : '') }}>
            {{ $i }}</option>
    @endfor
    <option value="{{ count($items) }}" {{ empty($pagination) ? '' : ($pagination == count($items) ? 'selected' : '') }}>
        All</option>
</select>
