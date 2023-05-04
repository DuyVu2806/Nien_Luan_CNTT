@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>User</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-triped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @php
                                            $maskedPhone= 'no Phone';
                                            $address = 'no Address';
                                            if (isset($item->UserDetail->phone)) {
                                                $phone = $item->UserDetail->phone;
                                                $maskedPhone = substr_replace(substr($phone, 2, -3), str_repeat('*', 5), 0, 5);
                                                $maskedPhone = substr_replace($phone, $maskedPhone, 2, -3);
                                            }
                                            if (isset($item->UserDetail->address)) {
                                                $address = $item->UserDetail->address;
                                            }

                                        @endphp
                                        {{ $maskedPhone }}
                                    </td>
                                    <td>
                                        @php
                                            $email = $item->email;
                                            $emailPrefix = substr($email, 0, strpos($email, '@'));
                                            $firstTwoChars = substr($emailPrefix, 0, 2);
                                            $maskedEmailPrefix = $firstTwoChars . str_repeat('*', strlen($emailPrefix) - 2);
                                            $emailSuffix = substr($email, strpos($email, '@'));
                                            $maskedEmail = $maskedEmailPrefix . $emailSuffix;
                                        @endphp
                                        {{ $maskedEmail }}
                                    </td>
                                    <td>{{ $item->role_as == 1 ? 'admin' : 'customer' }}</td>
                                    <td>{{ $address }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#role-as-{{ $item->id }}">Add role_admin</button>
                                    </td>
                                </tr>
                                {{-- start modal --}}
                                <div class="modal fade" id="role-as-{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ url('admin/users/' . $item->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Change Role Admin</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <select name="role_as" id=""
                                                        class="form-select form-select-lg mb-3 ">
                                                        <option value="0" {{ $item->role_as == 0 ? 'selected' : '' }}>
                                                            Customer</option>
                                                        <option value="1" {{ $item->role_as == 1 ? 'selected' : '' }}>
                                                            Admin</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                {{-- end modal --}}
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
