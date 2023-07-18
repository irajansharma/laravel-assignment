<!-- resources/views/form.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Form</title>
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('save') }}">
        @csrf

        <table>
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Child First Name</th>
                    <th>Child Middle Name</th>
                    <th>Child Last Name</th>
                    <th>Child Age</th>
                    <th>Gender</th>
                    <th>Different Address?</th>
                    <th>Child Address</th>
                    <th>Child City</th>
                    <th>Child State</th>
                    <th>Country</th>
                    <th>Child Zip Code</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($children as $index => $child)
                    <tr>
                        <td>
                            <button type="button" class="delete-row">Delete</button>
                            <input type="hidden" name="child_id[]" value="{{ $child->id }}">
                        </td>
                        <td>
                            <input type="text" name="first_name[]" value="{{ old('first_name.' . $index, $child->first_name) }}" required>
                            @error('first_name.' . $index)
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="middle_name[]" value="{{ old('middle_name.' . $index, $child->middle_name) }}" required>
                            @error('middle_name.' . $index)
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="last_name[]" value="{{ old('last_name.' . $index, $child->last_name) }}" required>
                            @error('last_name.' . $index)
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="age[]" value="{{ old('age.' . $index, $child->age) }}" required pattern="[0-9]+">
                            @error('age.' . $index)
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <select name="gender[]" required>
                                <option value="">Select Gender</option>
                                <option value="Male" @if(old('gender.' . $index, $child->gender) == 'Male') selected @endif>Male</option>
                                <option value="Female" @if(old('gender.' . $index, $child->gender) == 'Female') selected @endif>Female</option>
                            </select>
                            @error('gender.' . $index)
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="checkbox" name="different_address[{{ $index }}]" id="different_address_{{ $index }}" value="1" @if(old('different_address.' . $index, $child->different_address)) checked @endif>
                        </td>
                        <td>
                            <input type="text" name="address[]" value="{{ old('address.' . $index, $child->address) }}" @if(!old('different_address.' . $index, $child->different_address)) disabled @endif>
                            @error('address.' . $index)
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="city[]" value="{{ old('city.' . $index, $child->city) }}" @if(!old('different_address.' . $index, $child->different_address)) disabled @endif>
                            @error('city.' . $index)
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="state[]" value="{{ old('state.' . $index, $child->state) }}" @if(!old('different_address.' . $index, $child->different_address)) disabled @endif>
                            @error('state.' . $index)
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <select name="country[]" @if(!old('different_address.' . $index, $child->different_address)) disabled @endif>
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country }}" @if(old('country.' . $index, $child->country) == $country) selected @endif>{{ $country }}</option>
                                @endforeach
                            </select>
                            @error('country.' . $index)
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="zip_code[]" value="{{ old('zip_code.' . $index, $child->zip_code) }}" @if(!old('different_address.' . $index, $child->different_address)) disabled @endif pattern="[0-9]+">
                            @error('zip_code.' . $index)
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="button" id="add-row">Add New</button>

        <br><br>

        <button type="submit">Save</button>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add new row
            $('#add-row').click(function() {
                var newRow = $('<tr>' +
                    '<td>' +
                    '<button type="button" class="delete-row">Delete</button>' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="first_name[]" required>' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="middle_name[]" required>' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="last_name[]" required>' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="age[]" required pattern="[0-9]+">' +
                    '</td>' +
                    '<td>' +
                    '<select name="gender[]" required>' +
                    '<option value="">Select Gender</option>' +
                    '<option value="Male">Male</option>' +
                    '<option value="Female">Female</option>' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<input type="checkbox" name="different_address[]">' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="address[]" disabled>' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="city[]" disabled>' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="state[]" disabled>' +
                    '</td>' +
                    '<td>' +
                    '<select name="country[]" disabled>' +
                    '<option value="">Select Country</option>' +
                    '@foreach ($countries as $country)' +
                    '<option value="{{ $country }}">{{ $country }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="zip_code[]" disabled pattern="[0-9]+">' +
                    '</td>' +
                    '</tr>');

                $('table tbody').append(newRow);
            });

            // Delete row
            $(document).on('click', '.delete-row', function() {
                $(this).closest('tr').remove();
            });

            // Toggle address fields based on checkbox
            $(document).on('change', '[name^="different_address"]', function() {
                var index = $(this).closest('tr').index();
                var addressFields = $(this).closest('tr').find('input[name^="address"], input[name^="city"], input[name^="state"], select[name^="country"], input[name^="zip_code"]');

                if ($(this).is(':checked')) {
                    addressFields.prop('disabled', false);
                } else {
                    addressFields.prop('disabled', true);
                }
            });
        });
    </script>
</body>
</html>
