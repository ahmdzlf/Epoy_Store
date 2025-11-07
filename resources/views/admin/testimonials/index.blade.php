@extends('layouts.admin')

@section('title', 'Manage Testimonials')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Testimonials</h2>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Testimonial
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                @forelse($testimonials as $testimonial)
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-3">
                                @if($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                     class="rounded-circle me-3" 
                                     style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-3" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-user fa-lg"></i>
                                </div>
                                @endif
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">{{ $testimonial->name }}</h5>
                                    <small class="text-muted">{{ $testimonial->position }}</small>
                                    <div class="mt-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $testimonial->rating)
                                            <i class="fas fa-star text-warning"></i>
                                            @else
                                            <i class="far fa-star text-warning"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <div>
                                    @if($testimonial->is_active)
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </div>
                            </div>
                            <p class="mb-3">{{ Str::limit($testimonial->message, 150) }}</p>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-comment-slash fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No testimonials found</p>
                    </div>
                </div>
                @endforelse
            </div>
            
            <div class="mt-3">
                {{ $testimonials->links() }}
            </div>
        </div>
    </div>
</div>
@endsection