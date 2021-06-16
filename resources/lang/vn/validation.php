<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Phải được chấp nhận.',
    'active_url' => 'Địa chỉ URL không hợp lệ.',
    'after' => 'Phải sau ngày :date.',
    'after_or_equal' => 'Phải sau hoặc trong ngày :date.',
    'alpha' => 'Chỉ được chứa ký tự chữ cái.',
    'alpha_dash' => 'Chỉ được chứa ký tự chữ cái, số, dấu gạch chéo và dấu gạch chân.',
    'alpha_num' => 'Chỉ được chứa ký tự chữ và số.',
    'array' => 'Phải là một mảng.',
    'before' => ':attribute phải trước ngày :date.',
    'before_or_equal' => ':attribute phải trong hoặc trước ngày :date.',
    'between' => [
        'numeric' => 'Phải ở trong khoảng :min và :max.',
        'file' => 'Phải ở trong khoảng :min và :max kilobytes.',
        'string' => 'Phải ở trong khoảng :min và :max ký tự.',
        'array' => 'Phải ở trong khoảng :min và :max lựa chọn.',
    ],
    'boolean' => 'Phải là có hoặc không.',
    'confirmed' => 'Không thể xác nhận.',
    'date' => 'Ngày không hợp lệ.',
    'date_equals' => 'Phải trong ngày :date.',
    'date_format' => 'Không phải kiểu định dạng :format.',
    'different' => ':attribute và :other phải khác nhau.',
    'digits' => ':attribute phải là :digits digits.',
    'digits_between' => ':attribute phải là :min and :max số.',
    'dimensions' => 'Kích thước hình ảnh không hợp lệ.',
    'distinct' => ':attribute chứa giá trị bị trùng lặp.',
    'email' => ':attribute phải là địa chỉ E-Mail họp lệ.',
    'ends_with' => ':attribute phải kết thúc với: :values.',
    'exists' => 'Lựa chọn không hợp lệ.',
    'file' => 'Phải là tệp tin.',
    'filled' => ':attribute phải chứa ít nhất một giá trị.',
    'gt' => [
        'numeric' => 'Phải lớn hơn :value.',
        'file' => 'Phải lớn hơn :value kilobytes.',
        'string' => 'Phải lớn hơn :value ký tự.',
        'array' => 'Phải lớn hơn :value lựa chọn.',
    ],
    'gte' => [
        'numeric' => 'Phải lớn hơn hoặc bằng :value.',
        'file' => 'Phải lớn hơn hoặc bằng :value kilobytes.',
        'string' => 'Phải lớn hơn hoặc bằng :value ký tự.',
        'array' => 'Phải có :value lựa chọn hoặc nhiều hơn.',
    ],
    'image' => 'Phải là hình ảnh.',
    'in' => 'Lựa chọn không hợp lệ.',
    'in_array' => ':attribute không tồn tại trong :other.',
    'integer' => ':attribute phải là số nguyên.',
    'ip' => ':attribute phải là địa chỉ IP hợp lệ.',
    'ipv4' => ':attribute phải là địa chỉ IPv4 hợp lệ.',
    'ipv6' => ':attribute phải là địa chỉ IPv6 hợp lệ.',
    'json' => 'phải là chuỗi JSON hợp lệ.',
    'lt' => [
        'numeric' => 'Phải nhỏ hơn :value.',
        'file' => 'Phải nhỏ hơn :value kilobytes.',
        'string' => 'Phải nhỏ hơn :value ký tự.',
        'array' => 'Phải nhỏ hơn :value lựa chọn.',
    ],
    'lte' => [
        'numeric' => 'Phải nhỏ hơn hoặc bằng :value.',
        'file' => 'Phải nhỏ hơn hoặc bằng :value kilobytes.',
        'string' => 'Phải nhỏ hơn hoặc bằng :value ký tự.',
        'array' => 'Phải nhỏ hơn hoặc bằng :value lựa chọn.',
    ],
    'max' => [
        'numeric' => 'không được nhiều hơn :max.',
        'file' => 'không được nhiều hơn :max kilobytes.',
        'string' => 'không được nhiều hơn :max ký tự.',
        'array' => 'không được nhiều hơn :max lựa chọn.',
    ],
    'mimes' => 'Phải là định dạng: :values.',
    'mimetypes' => 'Phải là định dạng: :values.',
    'min' => [
        'numeric' => 'Phải có ít nhất :min.',
        'file' => 'Phải có ít nhất :min kilobytes.',
        'string' => 'Phải có ít nhất :min ký tự.',
        'array' => 'Phải có ít nhất :min lựa chọn.',
    ],
    'not_in' => 'Lựa chọn :attribute không hợp lệ.',
    'not_regex' => 'Định dạng không hợp lệ.',
    'numeric' => 'Phải là số.',
    'password' => 'Sai mật khẩu.',
    'present' => 'Phải có :attribute.',
    'regex' => 'Định dạng không hợp lệ.',
    'required' => 'Bắt buộc.',
    'required_if' => ':attribute là bắt buộc khi :other là :value.',
    'required_unless' => ':attribute là bắt buộc trừ khi :other là :values.',
    'required_with' => ':attribute là bắt buộc khi có :values .',
    'required_with_all' => ':attribute là bắt buộc khi có :values.',
    'required_without' => ':attribute là bắt buộc khi không có :values .',
    'required_without_all' => ':attribute là bắt buộc khi không có :values nào.',
    'same' => ':attribute và :other phải giống nhau.',
    'size' => [
        'numeric' => 'Phải có :size.',
        'file' => 'Phải có :size kilobytes.',
        'string' => 'Phải có :size ký tự.',
        'array' => 'Phải chứa :size lựa chọn.',
    ],
    'starts_with' => 'Phải bắt đầu với: :values.',
    'string' => 'Phải là một chuỗi ký tự.',
    'timezone' => 'Phải nằm trong khu vực hợp lệ.',
    'unique' => ':attribute đã được sử dụng trước đó.',
    'uploaded' => ':attribute đăng tải thất bại.',
    'url' => 'định dạng :attribute không hợp lệ.',
    'uuid' => ':attribute phải là UUID họp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'arrive_time' => 'thời gian đến',
        'start_airport_ID' => 'Điểm đi',
        'arrive_airport_ID' => 'Điểm đến',
        'date_from' => 'Ngày đi',
        'date_to' => 'Ngày về',
    ],

];
