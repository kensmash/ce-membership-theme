/* eslint-disable */
;(function ($) {
	/**
	 * initializeBlock
	 *
	 * Adds custom JavaScript to the block HTML.
	 *
	 * @date    15/4/19
	 * @since   1.0.0
	 *
	 * @param   object $block The block jQuery element.
	 * @param   object attributes The block attributes (only available when editing).
	 * @return  void
	 */
	var initializeBlock = function ($block) {
		$block.addClass('umc-countdown-clock-block')
		$block.umcCountdownClocks()
	}

	// Initialize each block on page load (front end).
	$(document).ready(function () {
		$('.umc-countdown-clock').each(function () {
			$(this).umcCountdownClocks()
		})
	})

	$.umcCountdownClocks = function (el, options) {
		//console.log('countdown clock script running')
		// To avoid scope issues, use 'base' instead of 'this'
		// to reference this class from internal events and functions.
		var base = this

		base.$el = $(el)
		base.el = el

		base.$el.data('umcCountdownClocks', base)

		base.className = '.umc-countdown-clock'

		function makeTimer() {
			//var endTime = new Date('4 December 2023 8:00:00 CST')
			var endTime = $('.umc-countdown-clock__timer').attr('data-countdowndate')
			//console.log('endTime? ', endTime)
			endTime = Date.parse(endTime) / 1000

			var now = new Date()
			now = Date.parse(now) / 1000

			var timeLeft = endTime - now

			var days = Math.floor(timeLeft / 86400)
			var hours = Math.floor((timeLeft - days * 86400) / 3600)
			var minutes = Math.floor((timeLeft - days * 86400 - hours * 3600) / 60)
			var seconds = Math.floor(timeLeft - days * 86400 - hours * 3600 - minutes * 60)

			if (hours < '10') {
				hours = '0' + hours
			}
			if (minutes < '10') {
				minutes = '0' + minutes
			}
			if (seconds < '10') {
				seconds = '0' + seconds
			}

			$('#days').html(days + '<span>Days</span>')
			$('#hours').html(hours + '<span>Hours</span>')
			$('#minutes').html(minutes + '<span>Minutes</span>')
			$('#seconds').html(seconds + '<span>Seconds</span>')
		}

		setInterval(function () {
			makeTimer()
		}, 1000)
	}

	$.fn.umcCountdownClocks = function (options) {
		return this.each(function () {
			new $.umcCountdownClocks(this, options)
		})
	}

	// Initialize dynamic block preview (editor).
	if (window.acf) {
		window.acf.addAction('render_block_preview/type=umc-countdown-timer-block', initializeBlock)
	}
})(jQuery)