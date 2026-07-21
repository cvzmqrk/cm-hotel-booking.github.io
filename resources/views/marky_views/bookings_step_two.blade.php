@extends('layouts.marky_app')

@section('marky_content')
<div class="max-w-2xl mx-auto bg-white rounded-xl border border-slate-200 shadow-sm p-8">
    <div class="mb-8">
        <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Step 2 of 3</span>
        <h2 class="text-xl font-bold text-slate-900 mt-1">Verification Artifact Upload</h2>
    </div>

    <form action="{{ route('marky_bookings.wizard.step_two.post') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="border-2 border-dashed border-slate-200 rounded-xl p-8 text-center bg-slate-50 relative">
            <label class="cursor-pointer block">
                <span class="block text-sm font-medium text-slate-700 mb-1">Select payment confirmation receipt or corporate authorization file</span>
                <span class="block text-xs text-slate-400 mb-4">(Accepted extensions: PDF, JPG, PNG - Max file capacity: 2MB)</span>
                
                <input type="file" name="marky_confirmation_file" id="marky_file_input" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </label>

            <div id="marky_preview_container" class="mt-6 hidden border border-slate-200 rounded-lg p-2 bg-white max-w-xs mx-auto">
                <p class="text-xs font-bold text-slate-400 uppercase mb-2">Selected File Preview:</p>
                <img id="marky_image_preview" src="#" alt="Artifact Preview" class="w-full h-auto rounded border border-slate-100 object-contain max-h-48">
            </div>
        </div>
        @error('marky_confirmation_file') <span class="text-xs text-rose-600 block mt-1">{{ $message }}</span> @enderror

        <div class="flex justify-between space-x-4 pt-4">
            <a href="{{ route('marky_bookings.wizard.step_one') }}" class="w-1/3 text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm py-3 px-4 rounded-lg transition">Back</a>
            <button type="submit" class="w-2/3 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-3 px-4 rounded-lg shadow transition">Proceed to Summary</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('marky_file_input').addEventListener('change', function(event) {
        const [file] = event.target.files;
        const previewContainer = document.getElementById('marky_preview_container');
        const imagePreview = document.getElementById('marky_image_preview');

        if (file) {
            const fileType = file.type;
            // Check if the uploaded file is an image format
            if (fileType.startsWith('image/')) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                
                reader.readAsDataURL(file);
            } else {
                // Hide preview area if a PDF or alternative document is chosen
                previewContainer.classList.add('hidden');
            }
        }
    });
</script>
@endsection