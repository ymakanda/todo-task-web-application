@props(['options' => []])

<select {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>{{$slot}}>
   @foreach($options as $key => $value )
        <option  value="{{ $value->id }}"> {{ isset($value->title) ? $value->title: $value->name }}</option>
   @endforeach 
    
</select>