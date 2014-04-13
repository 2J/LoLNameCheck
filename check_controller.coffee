homeApp = angular.module 'check' , []

homeApp.controller 'checkController', ['$scope', '$http', ($scope,$http) ->
  $scope.valid = 999    #999=untouched, 0=username not valid, 1=available(not taken), 2=available(expired), 3=taken
  $scope.info = undefined
  $scope.response = 404
  $scope.freedate
  $scope.revdate
  $scope.regions = [
    {name:"NA",api:"na"}
    {name:"EUNE",api:"eune"}
    {name:"EUW",api:"euw"}
    {name:"BR",api:"br"}
    {name:"LAN",api:"lan"}
    {name:"LAS",api:"las"}
    {name:"OCE",api:"oce"}
  ]
  $scope.region = $scope.regions[0]
  username = ''
  apiname=''
  $scope.check = ->
    username = $scope.username
    `apiname = $scope.username.replace(/ /g,'').toLowerCase();`
    resetdivs()
    if ((apiname.length<2) || (apiname.length>16) || (/[^a-zA-Z0-9]/.test( apiname ))) 
      #username not valid
      $scope.valid=0
      document.querySelector('#result').innerHTML = 'Summoner name not valid'
      return false
    else
      #username valid
      $scope.valid=0
      document.querySelector('#result').innerHTML = 'Searching for summoner '.concat(apiname).concat('...')
      APIKEY = '' #PUT API KEY HERE
      url = 'https://prod.api.pvp.net/api/lol/'.concat($scope.region.api).concat('/v1.4/summoner/by-name/').concat(apiname).concat('?api_key=').concat(APIKEY)
      `window.setTimeout(function(){},500)`
      $http.get url
        .success (data,status) ->
          $scope.info = data
          $scope.response = status
          if($scope.response == 403) 
            document.querySelector('#result').innerHTML = "403 error'"
            $scope.valid=0
          else if($scope.response == 200) 
            $scope.revdate = new Date($scope.info[apiname].revisionDate)
            monthsuntil = if($scope.info[apiname].summonerLevel < 6) then 6 else ($scope.info[apiname].summonerLevel)
            $scope.freedate = new Date(new Date($scope.revdate).setMonth($scope.revdate.getMonth()+monthsuntil))
            $scope.valid = if ($scope.freedate < (new Date(Date.now()))) then 2 else 3
            
            output($scope.valid, monthsuntil)
          else 
            document.querySelector('#result').innerHTML = $scope.response.concat('error')
            $scope.valid = 0
        .error ->
          $scope.valid = 1
          output(1)
   
  resetdivs = ->
    document.querySelector('#result').innerHTML = ''
    document.querySelector('#dname').innerHTML = ''
    document.querySelector('#davail').innerHTML = ''
    document.querySelector('#davaildate').innerHTML = ''
  output = (option, monthsuntil=0)-> 
    resetdivs()
    daysuntil=0
    if option==1 #Username is not taken
      $scope.cssname = {"background-color":"#437529", "color": "white", "text-align":"center"}
    else if option==2 #Username is taken but expired
      $scope.cssname = {"background-color":"#437529", "color": "white", "text-align":"center"}
      $scope.cssavaildate = {"background-color":"#437529", "color": "white"}
    else if option==3 #Username is taken
      daysuntil= Math.round(($scope.freedate.getTime() - Date.now())/ 86400000)
      $scope.cssname = {"background-color":(if (daysuntil<90) then "#CF7800" else "#A60000"), "color": "white", "text-align":"center"}
      $scope.cssavaildate = {"background-color":(if (daysuntil<90) then "#CF7800" else "#A60000"), "color": "white"}
    if (option==2) or (option==3)
      document.querySelector('#davaildate').innerHTML = "<br>Last Activity: ".concat(($scope.revdate).toUTCString())\
      .concat("<br> Level: ").concat($scope.info[apiname].summonerLevel)\
      .concat("<br> It takes ").concat(monthsuntil).concat(" months for name cleanup")\
      .concat("<br> Name clearnup if inactive: ").concat(($scope.freedate).toUTCString())
      .concat(if option==3 then "<br> Days until name avaiable: ".concat(daysuntil).concat(" day(s)") else '')
    document.querySelector('#dname').innerHTML = "\"".concat(username).concat("\" is ").concat(if option!=3 then "(probably) available!" else (if (daysuntil<90) then "available soon (if inactive)" else "unavailable."))
]
