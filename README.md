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

#   Technicality
    This project uses OOP pattern.
    It also demonstrates two main advance concepts.
      1. Service Oriented Architecture.(Abstract[WorldMoney] and concrete[USAMoney] )
      2. Repository pattern (AppMoneyRepository class).

#   Scalability
    Project was built with Scalability in mind. Project currently handles USA dollar and cents denomination pattern,
    but has the potential of handling other currencies denominations that do not fall within the same pattern.
    The parent service takes care of most known denominations without the coins. Coins are handled by child services since such
    denomination could be specific to countries (e.g a lot of countries don't have Quarters).
    Now to handle other denomination patterns we only need to take these 3 steps.
    1. Create a new service that extends our parent Service(WorldMoney) or child service USAMoney(if child has denominations).
    2. Create two properties sBank and bank of type array. bank having an associative array of denominations ordered
       from highest to lowest, sBank having a list of the denominations ordered exactly as bank.
    3. Last and final step, add methods that are not currently present in the parent class or child(if child was extended)
       following the same naming convention as the parent class.


#   Functionality
    #input Accepts amount provided at input amount_provided(in dollars and/or cents), total cost at param total_cost(in dollars and/or cents)
    #output Returns your change amount in Dollars and/or cents. Also provides the exact change by returning the count of each denomination of bills and/or coins.
    * Note: All returns are in JSON format.

#   Testing
    PHPUnit testing was used in this project.
