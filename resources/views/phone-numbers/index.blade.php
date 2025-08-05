@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Phone Numbers</h4>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="country" class="form-label">Country</label>
            <select name="country_code" id="country" class="form-select">
                @foreach($countries as $code => $name)
                    <option value="{{ $code }}" {{ request()->query('country_code') == $code ? 'selected' : '' }}>
                        {{ $name }} ({{ $code }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label for="state" class="form-label">Phone State</label>
            <select name="state" id="state" class="form-select">
                @foreach($states as $state => $name)
                    <option value="{{ $state }}" {{ request()->query('state') == $state ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Country</th>
                    <th>State</th>
                    <th>Country Code</th>
                    <th>Phone Num.</th>
                </tr>
            </thead>
            <tbody>
                @forelse($collection as $row)
                    <tr>
                        <td>{{ $row->country_name }}</td>
                        <td>{{ $row->state_label }}</td>
                        <td>{{ $row->country_code }}</td>
                        <td>{{ $row->phone_number }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No customers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $collection->links() }}
</div>
@endsection
