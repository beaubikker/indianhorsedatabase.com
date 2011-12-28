function grapheneGetTweet( tweets ){
    if ( ! ( window.grapheneTweetsCount ) ){
        window.grapheneTweetsCount = 0;
    }
    window.grapheneTweetsCount++;
    window['grapheneTweets-' + window.grapheneTweetsCount] = tweets;
}

function grapheneTwitter( target, options ) {
  
    var statusHTML = [];
    var twitters = window['grapheneTweets-' + window.grapheneTweetsCount];
    
    for (var i = 0; i < options.count; i++){
        var username = twitters[i].user.screen_name;
        var status = twitters[i].text
        
        // Linkify links
        status = status.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
          return '<a href="'+url+'">'+url+'</a>';
        });
        
        // Linkify @
        status = status.replace(/\B@([_a-z0-9]+)/ig, function(reply) {
          return  reply.charAt(0)+'<a href="http://twitter.com/#!/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
        });
        
        // Linkify hashtags
        status = status.replace(/(^|[^&\w'"]+)\#([a-zA-Z0-9_^"^<]+)/g, function(m, m1, m2) {
            return m.substr(-1) === '"' || m.substr(-1) == '<' ? m : m1 + '<strong>#<a href="http://twitter.com/#!/search/%23' + m2 + '">' + m2 + '</a></strong>';
        });
        
        status = ('<li><span>'+status+'</span> <a style="font-size:85%" href="http://twitter.com/'+username+'/statuses/'+twitters[i].id_str+'">'+relative_time(twitters[i].created_at)+'</a></li>');

        if ( options.newwindow )
            status = status.replace( /<a href=/gi, '<a target="_blank" href=' );
        
        statusHTML.push(status);
      
        if ( options.followercount ) {
            followerCount = twitters[i].user.followers_count;
            if ( followerCount == 0 )
                followerCount = '';
            else if ( followerCount == 1 )
                followerCount += ' ' + options.followersingle;
            else
                followerCount += ' ' + options.followerplural;
            followerCount += ' | ';
            
            document.getElementById('#follower-count-' + target).innerHTML = followerCount;
        }
    }
    document.getElementById( target ).innerHTML = statusHTML.join('');
}

function relative_time(time_value) {
    var values = time_value.split(" ");
    time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
    var parsed_date = Date.parse(time_value);
    var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
    var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
    delta = delta + (relative_to.getTimezoneOffset() * 60);
    
    if (delta < 60) {
    	return 'less than a minute ago';
    } else if(delta < 120) {
      	return 'about a minute ago';
    } else if(delta < (60*60)) {
      	return (parseInt(delta / 60)).toString() + ' minutes ago';
    } else if(delta < (120*60)) {
      	return 'about an hour ago';
    } else if(delta < (24*60*60)) {
      	return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
    } else if(delta < (48*60*60)) {
      	return '1 day ago';
    } else {
      	return (parseInt(delta / 86400)).toString() + ' days ago';
    }
}