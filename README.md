# Switch Project.
This project was built with symfony4 PHP framework.
#
    This is a simple api end point which accepts two parameters total_cost and amount_provided.
    total_cost is the amount incurred on a single transaction, amount_provided is the exact amount paid

#   endpoint
    Sample endpoint with input => http://switch.test/api/checkout?total_cost=234.34&amount_provided=340.35
    Sample output => {"error":0,"status":201,"balance":"$106.01","change":{"Hundred":1,"Five":1,"One":1,"Penny":1}}

#   Currency
    Api will return an error if input falls within the following specs.
    1. Input is not a number.
    2. Contains any special characters other than '.' or url friendly Characters(Note only amount before such special character would
        be processed).
    3. Input has more than 2 decimal places.

    4. Input larger than 9999999999.99

#   Technicality
    This project uses OOP pattern.
    It also demonstrates two main advance concepts.
      1. Service Oriented Architecture.(Abstract[WorldMoney] and concrete[USAMoney] )
      2. Repository pattern (AppMoneyRepository class).

#   Scalability
    Project was built with Scalability in mind. Project currently handles USA dollar and cents denomination pattern,
    but has the potential of handling other currencies denominations that do not fall within the same pattern.

    Now to handle other denomination patterns we only need to take two steps.
    1. Create a new service that extends our parent Service(WorldMoney) or child service USAMoney(if child has denominations).

    2. Create two associative arrays denom and bank. denom having (values of all denominations in descending order), bank having same
      value as denom but set to zero.

#   Functionality
    #input Accepts amount provided at input amount_provided(in dollars and/or cents), total cost at param total_cost(in dollars and/or cents)
    #output Returns your change amount in Dollars and/or cents. Also provides the exact change by returning the count of each denomination of bills and/or coins.
    * Note: All returns are in JSON format.

#   Testing
    PHPUnit testing was used in this project.

#   To do!
    Will be converting this project to a fully functional self checkout program. stay tunned!!
