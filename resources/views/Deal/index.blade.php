@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/3.0.24/tailwind.min.css">
    <style>
        .kanban-stage {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            width: 300px;
            min-height: 500px;
            background: #f9f9f9;
        }
        .kanban-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            background: #fff;
            cursor: move;
        }
    </style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الصفقات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ سجل الصفقات</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
                @can('add deal')
				<div class="row">
                        <a href="{{route('deal.create')}}" class="btn btn-success-gradient btn-with-icon ">
                            <i class="typcn typcn-plus"> اضافة صفقة </i>    </a></div>
                @endcan
                <div class="flex">
                    @foreach ($journeys as $journey)
                        <div class="kanban-stage" data-journey-id="{{ $journey->id }}">
                            <h2 class="font-bold text-lg mb-4">{{ $journey->name }}</h2>
                            @foreach ($journey->stages as $stage)
                                <div class="stage" data-stage-id="{{ $stage->id }}" data-journey-id="{{ $journey->id }}">
                                    <h3 class="font-semibold text-md mb-2">{{ $stage->name }}</h3>
                                    @foreach ($stage->deals as $deal)
                                        <div class="kanban-card" data-deal-id="{{ $deal->id }}">
                                            <h4 class="font-bold">{{ $deal->title }}</h4>
                                            <p>{{ $deal->description }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>



				<!-- row closed -->

			<!-- Container closed -->
		<!-- main-content closed -->
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const drake = dragula(Array.from(document.querySelectorAll('.stage')), {
                revertOnSpill: true,
                accepts: function (el, target, source, sibling) {
                    return true;
                }
            });

            drake.on('drop', function (el, target, source, sibling) {
                const dealId = el.getAttribute('data-deal-id');
                const stageId = target.getAttribute('data-stage-id');

                fetch('{{ route('kanban.updateDealStatus') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        deal_id: dealId,
                        stage_id: stageId
                    }),
                }).then(response => response.json()).then(data => {
                    if (!data.success) {
                        alert('Failed to update deal status');
                    }
                }).catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    </script>

@endsection
