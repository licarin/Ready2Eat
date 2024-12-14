<div class="mb-4">
    <label for="name" class="block text-gray-700">Name</label>
    <input type="text" id="name" name="name" class="w-full border p-2 rounded" 
           value="{{ old('name', $restaurant->name ?? '') }}" required>
</div>
<div class="mb-4">
    <label for="location" class="block text-gray-700">Location</label>
    <input type="text" id="location" name="location" class="w-full border p-2 rounded" 
           value="{{ old('location', $restaurant->location ?? '') }}" required>
</div>
<div class="mb-4">
    <label for="average_price" class="block text-gray-700">Average Price</label>
    <input type="number" id="average_price" name="average_price" class="w-full border p-2 rounded" 
           value="{{ old('average_price', $restaurant->average_price ?? '') }}" required>
</div>
<div class="mb-4">
    <label for="description" class="block text-gray-700">Description</label>
    <textarea id="description" name="description" class="w-full border p-2 rounded">{{ old('description', $restaurant->description ?? '') }}</textarea>
</div>
<div class="mb-4">
    <label for="photo" class="block text-gray-700">Restaurant Photo</label>
    <input type="file" id="photo" name="photo" class="w-full border p-2 rounded">
    @if(isset($restaurant->photos))
        <img src="{{ asset('storage/' . $restaurant->photos) }}" alt="Restaurant Photo" class="mt-2 h-20 w-20">
    @endif
</div>
