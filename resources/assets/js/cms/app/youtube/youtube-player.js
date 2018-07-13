class Youtube {

	constructor(youtube_url, options, events) {

		Storage.exists('videosProgress').then((videosProgress) => {
			this.videosProgress = videosProgress;
		}, () => {
			this.videosProgress = {};	
		});


		window.onYouTubeIframeAPIReady = () => {
            this.player = new YT.Player('player', {
                height: '100%',
                width: '100%',
                videoId: youtube_url,
                playerVars: options,
                events: events
            });
        }

	}

	/**
	 * Toggle fullscreen for the current youtube player
	 */
	toggleFullScreen() {
		let iframe = $('#player')[0];
		
		let requestFullScreen = iframe.requestFullScreen || iframe.mozRequestFullScreen || iframe.webkitRequestFullScreen;
		
		if (requestFullScreen) {
			requestFullScreen.bind(iframe)();
		}
	}

	/**
	* Load a video into the youtube player
	*
	*/
	loadVideo(video) {
	  // save activeVideo to localStorage.
        Storage.set('activeVideo', video);

		this.player.loadVideoById({
            'videoId': video.youtube_url,
            'startSeconds': this.getVideoProgress(video),
            'suggestedQuality': 'small'
        });
		
        this.trackVideoProgresss(video);
	}

	/**
	* Get the progress for a given video
	*
	*/
	getVideoProgress(video) {
		return this.videosProgress[video.id] !== undefined ? this.videosProgress[video.id] : 0;
	}

	/**
	* track the progress from a given video
	*
	*/
	trackVideoProgresss(video) {
		// clear the previous interval.
        clearInterval(this.interval);

        // start a new interval.
        this.interval = setInterval(() => {
            this.videosProgress[video.id] = this.player.getCurrentTime();
            Storage.set('videosProgress', this.videosProgress);
        }, 1000);
	}



}

export default Youtube;