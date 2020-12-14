# Covid Cases Api
<p>Only a technique challenge api</p>
<p>This api exposes an Endpoint in order to filter higher percentual covid cases by a state given and a period.
Then it sends a POST request to register the higher percentual of a city to the endpoint:</p>

`https://api.brasil.io/v1/dataset/covid19/caso/data/?state=MG&date=2020-05-10&order_for_place=10`

## Covid Case Endpoint:

You may specify state, start date, end date and per page results if wished. 

`api/covid-case/high/percentual/cases/{state}/{dateStart}/{dateEnd}/{?perPage}` 
