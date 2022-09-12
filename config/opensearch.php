<?php

return [

    /**
     * You can specify one of several different connections when building an
     * OpenSearch client.
     *
     * Here you may specify which of the connections below you wish to use
     * as your default connection when building an client. Of course you may
     * use create several clients at once, each with different configurations.
     */

    'defaultConnection' => 'default',

    /**
     * These are the connection parameters used when building a client.
     */

    'connections' => [

        'default' => [

            /**
             * Hosts
             *
             * This is an array of hosts that the client will connect to. It can be a
             * single host, or an array if you are running a cluster of OpenSearch
             * instances.
             *
             * This is the only configuration value that is mandatory.
             *
             * Presently using "extended" host configuration method
             */

            'hosts' => [
                [
                    'host'              => env('OPENSEARCH_HOST', 'localhost'),
                    // For local development, the default OpenSearch port is 9200.
                    // If you are connecting to an OpenSearch instance on AWS, you probably want to set this to null
                    'port'              => env('OPENSEARCH_PORT', 9200),
                    'scheme'            => env('OPENSEARCH_SCHEME', 'https'),

                    'user'              => env('OPENSEARCH_USER', null),
                    'pass'              => env('OPENSEARCH_PASS', null),

                    'basicAuthentication' => [
                      'username' => env('OPENSEARCH_USER', 'admin'),
                      'password' => env('OPENSEARCH_USER', 'admin'),
                    ],

                    // If you are connecting to an OpenSearch instance on AWS, you will need these values as well
                    'aws'               => env('AWS_OPENSEARCH_ENABLED', false),
                    'aws_region'        => env('AWS_REGION', ''),
                    'aws_key'           => env('AWS_ACCESS_KEY_ID', ''),
                    'aws_secret'        => env('AWS_SECRET_ACCESS_KEY', ''),
                    'aws_credentials'   => null,
                    'aws_session_token' => env('AWS_SESSION_TOKEN', null),
                ],
            ],

            /**
             * SSL
             *
             * If your OpenSearch instance uses an out-dated or self-signed SSL
             * certificate, you will need to pass in the certificate bundle.  This can
             * either be the path to the certificate file (for self-signed certs), or a
             * package like https://github.com/Kdyby/CurlCaBundle.  See the documentation
             * below for all the details.
             *
             * If you are using SSL instances, and the certificates are up-to-date and
             * signed by a public certificate authority, then you can leave this null and
             * just use "https" in the host path(s) above and you should be fine.
             *
             */

            'sslVerification' => null,

            /**
             * Logging
             *
             * Logging is handled by passing in an instance of Monolog\Logger (which
             * coincidentally is what Laravel's default logger is).
             *
             * If logging is enabled, you either need to set the path and log level
             * (some defaults are given for you below), or you can use a custom logger by
             * setting 'logObject' to an instance of Psr\Log\LoggerInterface.  In fact,
             * if you just want to use the default Laravel logger, then set 'logObject'
             * to \Log::getMonolog().
             *
             * Note: 'logObject' takes precedent over 'logPath'/'logLevel', so set
             * 'logObject' null if you just want file-based logging to a custom path.
             *
             */

            'logging' => false,

            // If you have an existing instance of Monolog you can use it here.
            // 'logObject' => \Log::getMonolog(),

            'logPath' => storage_path('logs/opensearch.log'),

            'logLevel' => Monolog\Logger::INFO,

            /**
             * Retries
             *
             * By default, the client will retry n times, where n = number of nodes in
             * your cluster. If you would like to disable retries, or change the number,
             * you can do so here.
             *
             */

            'retries' => null,

            /**
             * The remainder of the configuration options can almost always be left
             * as-is unless you have specific reasons to change them.  Refer to the
             * appropriate sections in the OpenSearch documentation for what each option
             * does and what values it expects.
             */

            /**
             * Sniff On Start
             *
             */

            'sniffOnStart' => false,

            /**
             * HTTP Handler
             *
             */

            'httpHandler' => null,

            /**
             * Connection Pool
             *
             */

            'connectionPool' => null,

            /**
             * Connection Selector
             *
             */

            'connectionSelector' => null,

            /**
             * Serializer
             *
             */

            'serializer' => null,

            /**
             * Connection Factory
             *
             */

            'connectionFactory' => null,

            /**
             * Endpoint
             *
             */

            'endpoint' => null,


            /**
             * Register additional namespaces
             *
             * An array of additional namespaces to register.
             *
             */
            'namespaces' => [],

            /**
             * Tracer
             *
             * Tracer is handled by passing in a name of the class implements Psr\Log\LoggerInterface.
             *
             */
            'tracer' => null,

        ],

    ],

];
