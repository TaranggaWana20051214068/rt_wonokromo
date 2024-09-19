@props(['homeRoute'])

<form action="" {{ $attributes }}>
    {{ $slot }}

    <div class="form-group g-2">
        <div class="input-group input-group-md">
            <input type="search" name="search" class="form-control form-control-lg" placeholder="Search..."
                value="{{ request('search') }}">

            <div class="input-group-append">
                <button type="submit" class="btn btn-lg btn-default">
                    <i class="fa fa-search"></i>
                </button>

                <select name="per_page" class="form-select" style="width: 100%; margin-left:10px;">
                    <?php $perPageOptions = [5, 10, 50, 100]; ?>
                    @foreach ($perPageOptions as $option)
                        <option value="{{ $option }}" {{ request('per_page', 10) == $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    @if (request('search'))
        <div class="callout callout-info">
            <a href="{{ $homeRoute }}" class="text-decoration-none">
                <h5 class="text-primary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Halaman Utama
                </h5>
            </a>
        </div>
    @endif
</form>
