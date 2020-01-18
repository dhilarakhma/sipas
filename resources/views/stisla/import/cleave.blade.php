@push('js')
<script src="{{ asset('stisla/node_modules/cleave.js/dist/cleave.min.js') }}"></script>
@endpush

@push('script')
<script>
	$(document).ready(function(){
		if($('.timemask').length > 0){
			$('.timemask').each(function(index, item){
				new Cleave(item, {
					delimiter: ':',
					blocks: [2, 2, 2],
				});
			})
		}

		if($('.uangmask').length > 0){
			$('.uangmask').each(function(index, item){
				new Cleave(item, {
					delimiter: '.',
					numeral: true,
					numeralDecimalMark : ',',
				});
			})

		}
	});
	function reloadUangMask(){
		$('.uangmask').each(function(index, item){
			new Cleave(item, {
				delimiter: '.',
				numeral: true,
				numeralDecimalMark : ',',
			});
		})
	}
</script>
@endpush