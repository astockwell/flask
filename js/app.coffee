$ ->
	$document = $(document)
	$window = $(window)

	# console.log 'hello'


	#
	# Enquire
	#
	# enquire.register("screen and (max-width:767px)", {
	# 	match: ->
	# 		console.log "matched mobile"
	# 	unmatch: ->
	# 		console.log "unmatched mobile"
	# })

	# enquire.register("screen and (min-width:768px)", {
	# 	match: ->
	# 		console.log "matched desktop"
	# 	unmatch: ->
	# 		console.log "unmatched desktop"
	# }, true)


	#
	# Optimized window.resize handling via requestAnimationFrame
	# Useage:
	# App.optimizedResize.add(function_that_you_would_have_called_on_every_resize)
	#
	# App.optimizedResize = do ->
	# 	callbacks = []
	# 	changed = false
	# 	running = false

	# 	# fired on resize event
	# 	resize = () ->
	# 		unless running
	# 			changed = true
	# 			rafLoop()

	# 	# resource conscious callback loop
	# 	rafLoop = () ->
	# 		unless changed
	# 			running = false
	# 		else
	# 			changed = false
	# 			running = true
	# 			callbacks.forEach (callback) ->
	# 				callback()
	# 			window.requestAnimationFrame(rafLoop)

	# 	# adds callback to loop
	# 	addCallback = (callback) ->
	# 		if callback
	# 			callbacks.push(callback)

	# 	return {
	# 		# initalize resize event listener
	# 		init: (callback) ->
	# 			if window.requestAnimationFrame
	# 				$window.on('resize', resize)
	# 				if callback
	# 					addCallback(callback)
	# 		# public method to add additional callback
	# 		add: (callback) ->
	# 			addCallback(callback)
	# 	}
	# App.optimizedResize.init()


	#
	# Utility function: Balance height of elements
	#
	balance_height_of_children = ->
		$els = $('.js-balance-children-height')
		$els.each ->
			$e = $(this)
			tallestElHeight = 0
			# Reset heights to auto
			$e.children().each ->
				$(this).css "height", "auto"
			# Calculate the height of the tallest submenu
			$e.children().each ->
				tallestElHeight = if tallestElHeight > $(this).outerHeight() then tallestElHeight else $(this).outerHeight()
			tallestElHeight = Math.ceil tallestElHeight
			$e.children().each ->
				$(this).css "height", "#{tallestElHeight}px"

	if $('.js-balance-children-height').length > 0
		$window
			.load(balance_height_of_children)
			.resize(balance_height_of_children)


	true