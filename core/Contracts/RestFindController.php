<?php declare(strict_types=1);

namespace Crate\Contracts;

use Psr\Http\Message\ResponseInterface;

/**
 * The RestFindController declares an additional and completely optional REST
 * design provided by Crate. You SHOULD not use this class without also 
 * implementing the main RestController interface as well.
 * 
 * GET|POST /[route]/find           -> find ()
 * Similar to the list method, but also supports POST HTTP requests. Of course, 
 * you can also stay with the list method, if you're cool with GET requests 
 * only, otherwise take this. 
 */
interface RestFindController
{

    /**
     * GET|POST /[route]/[identifier]
     *
     * @return ResponseInterface
     */
    public function find(): ResponseInterface;

}
