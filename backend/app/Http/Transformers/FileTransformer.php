<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;

class FileTransformer extends TransformerAbstract {
    protected $availableIncludes = [];

    private $defaultOptions = [
        'or' => 'auto',
        'fit' => 'fill',
        'q' => 100
    ];

    public function transform($data) {
        $response = [
            "id" => $data["id"],
            "path" => $data["path"],
            "type" => $data["type"],
            "name" => $data["name"],
            "entity" => $data["entity"],
            "purpose" => $data["purpose"],
	        "fullPath" => ($data["type"] === 'image') ? $this->sizeUrl($data["entity"], $data["path"], []) : asset('/storage/' . $data["entity"] . '/' . $data["type"] . '/' . $data["path"])
        ];

        if($data["type"] == 'image') {
            $response['sizes'] = [
	            'original' => $this->sizeUrl($data["entity"], $data["path"], []),
	            'profile' => [
		            '30w' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 30,
			            'h' => 30,
		            ]),
		            '30w2x' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 60,
			            'h' => 60,
		            ]),
		            '80w' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 80,
			            'h' => 80,
		            ]),
		            '80w2x' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 160,
			            'h' => 160,
		            ]),
		            '45w' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 45,
			            'h' => 45,
		            ]),
		            '45w2x' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 90,
			            'h' => 90,
		            ]),
		            '50w' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 50,
			            'h' => 50,
		            ]),
		            '50w2x' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 100,
			            'h' => 100,
		            ]),
	            ],

	            'users' => [
		            'xs' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 30,
			            'h' => 30,
		            ]),
		            'sm' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 50,
			            'h' => 50,
		            ]),
		            'md' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 80,
			            'h' => 80,
		            ]),
		            'lg' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 150,
			            'h' => 150,
		            ]),
		            'xl' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 200,
			            'h' => 200,
		            ])
	            ],
	            'companies' => [
		            'xs' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 30,
			            'h' => 30,
		            ]),
		            'xl' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 200,
			            'h' => 200,
		            ]),
	            ],
	            'bigLogo' => [
		            'xs' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 100
		            ]),
		            'xl' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 260
		            ]),
	            ],
	            'smallLogo' => [
		            'xs' => $this->sizeUrl($data["entity"], $data["path"], [
			            'w' => 30
		            ])
	            ],
                'headerLogo' => [
                    'size200w' => $this->sizeUrl($data["entity"], $data["path"], [
                        'w' => 200,
                        'h' => 50
                    ]),
                    'size200w2x' => $this->sizeUrl($data["entity"], $data["path"], [
                        'w' => 400,
                        'h' => 100
                    ]),
                ],
                'thumbnail' => [
                    'size35w' => $this->sizeUrl($data["entity"], $data["path"], [
                        'w' => 35,
                        'h' => 35
                    ]),
                    'size35w2x' => $this->sizeUrl($data["entity"], $data["path"], [
                        'w' => 70,
                        'h' => 70
                    ]),
                ],
            ];
        }

        return $response;
    }

    private function sizeUrl($entity, $path, $options) {
        return asset('/images/' . $entity . '/' . $path . $this->getQuery($options));
    }

    private function getQuery($options) {
        $q = [];
        $actualOptions = array_merge($options, $this->defaultOptions);

        foreach($actualOptions as $key => $value) {
            $q[] = $key . '=' . rawurlencode($value);
        }

        return empty($q) ? '' : '?' . implode('&', $q);
    }
}