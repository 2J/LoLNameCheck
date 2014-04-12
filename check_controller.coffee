homeApp = angular.module 'check' , []

homeApp.controller 'checkController', ['$scope', '$http', ($scope,$http) ->
  $scope.valid = 999    #999=untouched, 0=username not valid, 1=available(not taken), 2=available(expired), 3=taken
  $scope.info = undefined
  $scope.response = 404
  $scope.freedate
  $scope.revdate
  $scope.cssname = {"color":"#FF3333"}
  $scope.check = ->
    apiname = $scope.username.replace(' ','').toLowerCase();
    window.setInterval('',400);
    if ((apiname.length<2) || (apiname.length>16)) 
      #username not valid
      $scope.valid=0
      document.querySelector('#result').innerHTML = 'Summoner name not valid'
      return false
    else
      #username valid
      document.querySelector('#result').innerHTML = 'Searching for summoner '.concat(apiname).concat('...')
      APIKEY = '' #PUT API KEY HERE
      url = 'https://prod.api.pvp.net/api/lol/na/v1.4/summoner/by-name/'.concat(apiname).concat('?api_key=').concat(APIKEY)
      console.log url
      $http.get url
        .success (data,status) ->
          document.querySelector('#result').innerHTML = ''
          $scope.info = data
          $scope.response = status
          if($scope.response == 403) 
            document.querySelector('#result').innerHTML = "403 error'"
          else if($scope.response == 200) 
            document.querySelector('#dname').innerHTML = $scope.info[apiname].name
            $scope.revdate = new Date($scope.info[apiname].revisionDate)
            monthsuntil = if($scope.info[apiname].summonerLevel < 6) then 6 else ($scope.info[apiname].summonerLevel)
            $scope.freedate = new Date(new Date($scope.revdate).setMonth($scope.revdate.getMonth()+monthsuntil))
            $scope.valid = if ($scope.freedate < (new Date(Date.now()))) then 2 else 3
          else 
            document.querySelector('#result').innerHTML = $scope.response.concat('error')
        .error ->
          $scope.valid = 1
          document.querySelector('#dname').innerHTML = $scope.username
          document.querySelector('#davail').innerHTML = '(probably) Available!'
]