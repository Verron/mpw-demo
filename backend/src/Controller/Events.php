<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class Events extends AbstractController
{
    public function __construct(
        private readonly \MongoDB\Client $client,
    )
    {
    }

    #[Route('/api/v1/events', name: 'events', methods: ['GET'])]
    public function index(): Response
    {
        $cursor = $this->client->mpw->events->find();

        $events = [];

        foreach ($cursor as $document) {
            $event = $document;

            $event['id'] = $document['_id']->__toString();

            unset($event['_id']);

            $event['links']['self'] = $this->generateUrl('events_get', [
                'id' => $event['id'],
            ]);

            $events[] = $event;
        }

        return new JsonResponse([
            'message' => 'listed',
            'data' => $events
        ]);
    }

    #[Route('/api/v1/events', name: 'events_create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);


        $result = $this->client->mpw->events->insertOne($data);

        $data['id'] = $result->getInsertedId()->__toString();

        return new JsonResponse([
            'message' => 'created',
            'data' => $data,
        ]);
    }

    #[Route('/api/v1/events/{id}', name: 'events_get', methods: ['GET'])]
    public function read(string $id): Response
    {
        $result = $this->client->mpw->events->findOne([
            '_id' => new \MongoDB\BSON\ObjectId($id),
        ]);

        $event = $result;

        $event['id'] = $result['_id']->__toString();

        unset($event['_id']);

        return new JsonResponse([
            'message' => 'read',
            'data' => $event
        ]);
    }

    #[Route('/api/v1/events/{id}', name: 'events_update', methods: ['PUT'])]
    public function update(string $id, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $result = $this->client->mpw->events->updateOne([
            '_id' => new \MongoDB\BSON\ObjectId($id),
        ], [
            '$set' => $data,
        ]);

        return new JsonResponse([
            'message' => 'updated',
            'data' => $data,
        ]);
    }
}